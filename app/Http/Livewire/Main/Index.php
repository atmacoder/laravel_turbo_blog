<?php

namespace App\Http\Livewire\Main;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Http\Exceptions\HttpResp;

class Index extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public $categories;
    public $user;
    public $category = 0;
    public $isHomePag = True;

    protected $articles;

    protected $perPage = 10;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.main.index', [
            'articles' => $this->articles
        ]);

    }

    public function mount(Request $request)
    {
       $user = Auth::user();
       $this->user = $user;
       // if (!$user) {
            if ($request->category_id) {
                $this->category = $request->category_id;
                $this->articles = Article::Where('category_id', $request->category_id)->paginate($this->perPage);
                $this->isHomePag = False;
            } else {
                $this->articles = Article::paginate($this->perPage);
            }

            $this->categories = Category::all();
/*        } else {
            $this->skipRender();
            return redirect()->to('/no-permission');
        }*/
    }

    public function updatingPage($page)
    {
        return redirect()->to('/articles?page=' . $page . '&category_id=' . $this->category);
    }

    public function updatingCategory($category)
    {
        $this->category = $category;
        $this->page = 1;
        $this->articles = Article::where('category_id', $this->category)->paginate($this->perPage);

        return redirect()->to('/articles?page=1' . '&category_id=' . $this->category);
    }
}
