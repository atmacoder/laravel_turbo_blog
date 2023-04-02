<?php

namespace App\Http\Livewire\Dashboard\Articles;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Article;
use function LaravelLang\Publisher\Resources\toArray;

class ArticlesMetadatas extends Component


{
    use AuthorizesRequests;
    use WithPagination;

    protected $articles;

    public $newArticles = [];

    protected $perPage= 20;

    protected $paginationTheme = 'bootstrap';

    public function rules()
    {
        return [
            'articles.*.meta_description' => 'required|max:255',
            'articles.*.meta_keywords' => 'required|max:255',
        ];
    }

    public function render()
    {
        $articles = Article::latest()->paginate($this->perPage);

        $data = json_encode($articles);
        $data = json_decode($data);
        $this->newArticles = $data->data;

        return view('livewire.dashboard.articles.articles-metadatas',['articles' => $articles]);
    }

    public function mount(){

    }

    public function updatedNewArticles(){
        foreach ($this->newArticles as $a) {
            $article = Article::find($a['id']);
            $article->update(['meta_description' => $a['meta_description'], 'meta_keywords' => $a['meta_keywords']]);
        }
    }
}
