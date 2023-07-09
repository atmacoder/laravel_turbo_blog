<?php

namespace App\Http\Livewire\Dashboard\Comments;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Livewire\Component;
use \App\Models\Comment;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class CommentList extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    protected $comments;
    protected $perPage= 10;

    public function render()
    {
        $this->comments = Comment::with('article')->paginate($this->perPage);

        return view('livewire.dashboard.comments.comment-list',[
            'comments' => $this->comments
        ]);
    }

    public function mount(Request $request){

        $user = Auth::user();

        if (!$user->can('view_comments')) {
            $this->skipRender();
            return redirect()->to('/no-permission');
        }
        $this->comments = Comment::with('article')->paginate($this->perPage);

    }
    public function changeStatus($comment_id){

        $thisComment = Comment::find($comment_id);
        $thisComment->published = !$thisComment->published;
        $thisComment->update();

        $this->comments = Comment::with('article')->paginate($this->perPage);
       // return redirect()->to('/comments?page=' . $this->page);
    }

    public function openModuleCommentDelete($comment){
        $this->emit('activateModalCommentDelete', $comment);
    }

}
