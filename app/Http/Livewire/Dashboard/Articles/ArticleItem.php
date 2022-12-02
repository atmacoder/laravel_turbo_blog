<?php

namespace App\Http\Livewire\Dashboard\Articles;

use Livewire\Component;

class ArticleItem extends Component
{
    public $article;

    public function render()
    {
        return view('livewire.dashboard.articles.article-item');
    }
    public function openModuleDeleteArticle($article){
        $this->emit('activateModalArticleDelete', $article);
    }
    public function editArticle($id){
        $this->emit('editArticle', $id);
        return redirect()->route('article_edit', ['article_id'=> $id]);
    }
}
