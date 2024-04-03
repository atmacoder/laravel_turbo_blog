<?php

namespace App\Http\Livewire\Dashboard\Articles;

use Illuminate\Support\Str;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ArticleItem extends Component
{
    public $article;
    public $user;

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

        return redirect()->route('dashboard-articles', ['page'=> 1]);
    }
    public function mount(){
        $user = Auth::user();
        $this->user = $user;
        if (!$user || !$user->can('view_articles')) {
            $this->skipRender();
            return redirect()->to('/no-permission');
        }
    }
}
