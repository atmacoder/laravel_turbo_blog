<?php

namespace App\Http\Livewire\Main\Articles;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use \App\Models\User;

class Article extends Component
{
    public $article;
    public $article_slug;
    public $category;
    public $categories;
    public $category_slug;
    public $user;

    public function render()
    {
        return view('livewire.main.articles.article');
    }
    public function openModuleDeleteArticle($article){
        $this->emit('activateModalArticleDelete', $article);
    }
    public function editArticle($id){
        $this->emit('editArticle', $id);
        return redirect()->route('article_edit', ['article_id'=> $id]);
    }
    public function cloneArticle($id){

        $art = \App\Models\Article::with('extendTypes')->find($id);

        $newArticle = $art->replicate()->fill([
            'slug' => $art->slug . Str::random(16)
        ]);

        $newArticle->save();

        return redirect()->route('articles', ['page'=> 1]);
    }
    public function mount(Request $request, $article_slug, $category_slug)
    {
        $article = \App\Models\Article::where('slug', $article_slug)->with('extendTypes')->first();
        $this->article = $article;

        $category = \App\Models\Category::where('slug', $category_slug)->first();
        $this->category = $category;

        $this->categories = \App\Models\Category::all();

        // Форматирование даты
        $articleCreatedAt = Carbon::parse($article->created_at)->isoFormat('LLL');
        $this->article->created_at_formatted = $articleCreatedAt;
        // Количество комментариев
        $this->article->comments_count = $this->article->comments->Count();
        // Имя автора
        $user_name = User::find($article->user_id)->name;
        $this->article->user_name = $user_name;
    }
}
