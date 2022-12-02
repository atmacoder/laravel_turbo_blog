<?php

namespace App\Http\Livewire\Dashboard\Articles;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use App\Models\Article;
use Livewire\WithPagination;

class ArticlesList extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.dashboard.articles.articles-list', [

            'articles' => Article::paginate(10),

        ]);
    }
}
