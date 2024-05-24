<?php

namespace App\Http\Livewire\Dashboard\Articles;

use App\Models\Article;
use Illuminate\Support\Str;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ArticleItem extends Component
{
    public $article;
    public $user;
    public $page = 1;

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
    public function changeStatusPublished($article_id){

        $thisArticle = Article::with('category')->find($article_id);
        $thisArticle->published = !$thisArticle->published;
        $thisArticle->update();
        $this->article->published = $thisArticle->published;
        //return redirect()->to('/dashboard-articles?page' . $this->page . '&category_id=' . $thisArticle->category->id);
        // return redirect()->to('/comments?page=' . $this->page);
    }
    public function changeStatusArhive($article_id){

        $thisArticle = Article::with('category')->find($article_id);
        $thisArticle->arhive = !$thisArticle->arhive;
        $thisArticle->update();
        $this->article->arhive = $thisArticle->arhive;
        //return redirect()->to('/dashboard-articles?page' . $this->page . '&category_id=' . $thisArticle->category->id);
        // return redirect()->to('/comments?page=' . $this->page);
    }
}
