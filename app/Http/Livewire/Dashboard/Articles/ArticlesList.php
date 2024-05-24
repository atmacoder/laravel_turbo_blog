<?php

namespace App\Http\Livewire\Dashboard\Articles;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Article;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\RedirectResponse;

class ArticlesList extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public $categories;
    public $category = 0;

    protected $articles;

    protected $perPage = 10;
    public $limits = [10, 25, 50, 100, 250, 500];
    public $selectedLimit = 10;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.dashboard.articles.articles-list', [
            'articles' => $this->articles
        ]);

    }

    public function mount(Request $request)
    {
        if (session()->has('selectedLimit')) {
            $this->selectedLimit = session()->get('selectedLimit');
            //$this->perPage = $this->selectedLimit;
        }

        $user = Auth::user();
        if ($user->can('view_articles')) {
            if ($request->category_id) {
                $this->category = $request->category_id;
                $this->articles = Article::Where('category_id', $request->category_id)->latest()->paginate($this->selectedLimit);
            } else {
                $this->articles = Article::latest()->paginate($this->selectedLimit);
            }

            $this->categories = Category::all();
        } else {
            $this->skipRender();
            return redirect()->to('/no-permission');
        }
    }

    public function updatingPage($page)
    {
        return redirect()->to('/dashboard-articles?page=' . $page . '&category_id=' . $this->category);
    }

    public function updatingCategory($category)
    {
        $this->category = $category;
        $this->page = 1;
        $this->articles = Article::where('category_id', $this->category)->latest()->paginate($this->selectedLimit);

        return redirect()->to('/dashboard-articles?page=1' . '&category_id=' . $this->category);
    }

    public function updatedSelectedLimit()
    {
        $this->perPage = $this->selectedLimit;
        $this->page = 1;

        session()->put('selectedLimit', $this->selectedLimit);

        return redirect()->to('/dashboard-articles?page=1' . '&category_id=' . $this->category);
    }
}
