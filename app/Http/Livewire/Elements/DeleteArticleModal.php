<?php

namespace App\Http\Livewire\Elements;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use \App\Models\Article;

class DeleteArticleModal extends Component
{
    public $article_id,$article_name;

    protected $listeners = ['activateModalArticleDelete'];

    public function render()
    {
        return view('livewire.elements.delete-article-modal');
    }
    public function mount(){
        $user = Auth::user();
        if (!$user->can('delete_articles')) {
            $this->skipRender();
            return redirect()->to('/no-permission');
        }
    }
    public function activateModalArticleDelete($article){
        $this->article_id = $article['id'];
        $this->article_name = $article['title'];
    }
    public function deleteArticle($id){
        Article::find($id)->delete();
        return redirect()->to('/articles')->with('status', __('main.article').' '.$this->article_name . ' ' .__('main.created'));
    }
}
