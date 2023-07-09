<?php

namespace App\Http\Livewire\Elements;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use \App\Models\Comment;


class DeleteCommentModal extends Component
{
    public $comment_id,$comment_name;

    protected $listeners = ['activateModalCommentDelete'];


    public function render()
    {
        return view('livewire.elements.delete-comment-modal');
    }

    public function mount(){
        $user = Auth::user();
        if (!$user->can('delete_comments')) {
            $this->skipRender();
            return redirect()->to('/no-permission');
        }
    }
    public function activateModalCommentDelete($cat){
        $this->comment_id = $cat['id'];
        $this->comment_name = $cat['name'];
    }
    public function deleteComment($id){
        Comment::find($id)->delete();
        return redirect()->to('/comments')->with('status', __('main.comment').' '.$this->comment_name .' '.__('main.comment_deleted'));;
    }
}
