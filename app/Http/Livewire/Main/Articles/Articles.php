<?php

namespace App\Http\Livewire\Main\Articles;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class Articles extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public $categories;
    public $category_id = 0;
    public $category;
    public $user;
    public $isHomePag;

    protected $articles;

    protected $perPage = 50;
    public $limits = [10, 25, 50, 100, 250, 500];
    public $selectedLimit = 50;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.main.articles.articles', [
            'articles' => $this->articles
        ]);

    }

    public function mount(Request $request, $category)
    {
        $user = Auth::user();
        $this->user = $user;

        $this->isHomePag = True;

        if (session()->has('selectedLimit')) {
            $this->selectedLimit = session()->get('selectedLimit');
            $this->perPage = $this->selectedLimit;
        }

        if ($request->category_id && $request->category_id != 0) {
            $this->category = Category::findOrFail($this->category->id);
        }
        if ($category) {
            $this->category = $category;
        }

        if(!$this->articles) {
            if ($request->category_id && $request->category_id != 0) {
                $this->category_id = $request->category_id;
                $this->articles = Article::Where('category_id', $request->category_id)->with('extendTypes')->with('comments')->latest()->paginate($this->perPage);
                $this->isHomePag = False;
            } else {
                    if(!$category){
                        $this->articles = Article::paginate($this->perPage);
                        $this->isHomePag = True;
                    }
                    else{
                        $this->articles = Article::Where('category_id', $category->id)->with('extendTypes')->with('comments')->latest()->paginate($this->perPage);
                        $this->isHomePag = False;
                    }

            }
        }
        else{
            if($this->category) {
                $this->articles = Article::where('category_id', $this->category->id)->with('extendTypes')->with('comments')->latest()->paginate($this->perPage);
                $this->isHomePag = False;
            }
            else{
                $this->articles = Article::paginate($this->perPage);
                $this->isHomePag = True;
            }

        }
        if($this->category){
            $this->category_id = $this->category->id;
            SEOTools::setTitle($this->category->title);
            SEOTools::setDescription($this->category->meta_description);
            SEOMeta::setKeywords($this->category->meta_keywords);

            $url = '/' . $this->category->slug;
            OpenGraph::setTitle($this->category->title);
            OpenGraph::setUrl($url);
        }

    }

    public function updatingPage($page)
    {
        if($this->category){
            return redirect()->to($this->category->slug . '?page=' . $page);
        }
       else{
            return redirect()->to('/articles?page=' . $page . '&category_id=' . $this->category_id);
        }
    }

    public function updatingCategory($category)
    {
        $this->category = $category;
        $this->page = 1;

        $this->articles = Article::where('category_id', $this->category)->with('extendTypes')->with('comments')->paginate($this->perPage);

        return redirect()->to('/articles?page=1' . '&category_id=' . $this->category);
    }
    public function updatedSelectedLimit()
    {
        $this->perPage = $this->selectedLimit;
        $this->page = 1;

        session()->put('selectedLimit', $this->selectedLimit);

        if($this->category){
            return redirect()->to($this->category->slug . '?page=' .   $this->page);
        }
        else{
            return redirect()->to('/articles?page=' .   $this->page . '&category_id=' . $this->category_id);
        }
    }
}
