<?php

namespace App\Http\Livewire\Elements;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use \App\Models\ExtendArticleTypes;

class DeleteExtendArticleModal extends Component
{
    public $extend_article_id,$extend_article_name;

    protected $listeners = ['activateModalExtendArticleDelete'];

    public function render()
    {
        return view('livewire.elements.delete-extend-article-modal');
    }
    public function mount(){
        $user = Auth::user();
        if (!$user->can('delete_extend_article')) {
            $this->skipRender();
            return redirect()->to('/no-permission');
        }
    }
    public function activateModalExtendArticleDelete($article){
        $this->extend_article_id = $article['id'];
        $this->extend_article_name = $article['name'];
    }
    public function deleteExtendArticle($id){
        ExtendArticleTypes::find($id)->delete();
        return redirect()->to('/extend-article-list')->with('status', __('main.extend_articles').' '.$this->extend_article_name . ' ' .__('main.deleted'));
    }
}
