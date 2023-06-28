<?php

namespace App\Http\Livewire\Dashboard\Comments;

use Livewire\Component;
use \App\Models\Article;
use Livewire\WithPagination;

class CreateComment extends Component
{
    use WithPagination;

    public $name,$description,$email,$searchTerm, $article;

    protected $articles = [];

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';

        return view('livewire.dashboard.comments.create-comment',[
            'articles' => Article::where('title', 'like', $searchTerm)->paginate(10)
        ]);
    }
    public function createComment(){

    }
    public function setArticle($article){
        $this->article = $article;
    }
    public function updatedsearchTerm($data){
        $searchTerm = '%' . $this->searchTerm . '%';
        $this->articles = Article::where('title', 'like', $searchTerm)->paginate(10);
    }
}
