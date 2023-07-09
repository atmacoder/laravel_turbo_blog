<?php

namespace App\Http\Livewire\Dashboard\Comments;

use Livewire\Component;
use \App\Models\Article;
use \App\Models\Comment;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

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
    public function mount(){
        $user = Auth::user();
        if (!$user->can('create_comments')) {
            return redirect()->to('/no-permission');
        }
    }
    public function createComment(){
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'article' => 'required',
            'email' => 'required',
        ]);

        $comment = new Comment;
        $comment->name = $this->name;
        $comment->description = $this->description;
        $comment->email = $this->email;
        $comment->article_id = $this->article['id'];
        $comment->save();

        return redirect()->to('comments')->with('status',__('main.comment_created'));
    }
    public function setArticle($article){
        $this->article = $article;
    }
    public function updatedsearchTerm($data){
        $searchTerm = '%' . $this->searchTerm . '%';
        $this->articles = Article::where('title', 'like', $searchTerm)->paginate(10);
    }
}
