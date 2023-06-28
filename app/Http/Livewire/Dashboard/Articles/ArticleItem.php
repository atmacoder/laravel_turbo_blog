<?php

namespace App\Http\Livewire\Dashboard\Articles;

use Illuminate\Support\Str;
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
    public function cloneArticle($id){

        $art = \App\Models\Article::find($id);

        $newArticle = $art->replicate()->fill([
            'slug' => $art->slug . Str::random(16)
        ]);

        $newArticle->save();

        return redirect()->route('articles', ['page'=> 1]);
    }
}
