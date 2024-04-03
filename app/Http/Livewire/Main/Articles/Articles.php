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

class Articles extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public $categories;
    public $category_id = 0;
    public $user;

    protected $articles;

    protected $perPage = 10;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.main.articles.articles', [
            'articles' => $this->articles
        ]);

    }

    public function mount(Request $request, $articles, $category)
    {

        $user = Auth::user();
        $this->user = $user;
        if(!$articles) {
            if ($request->category_id) {
                $this->category_id = $request->category_id;
                $this->articles = Article::Where('category_id', $request->category_id)->with('comments')->paginate($this->perPage);
            } else {
                $this->articles = Article::paginate($this->perPage);
            }
        }
        else{
            if($category) {
                $this->articles = Article::where('category_id', $category->id)->with('comments')->paginate($this->perPage);
            }
            else{
                $this->articles = Article::paginate($this->perPage);
            }

        }
        if($category){
            SEOTools::setTitle($category->title);
            SEOTools::setDescription($category->meta_description);
            SEOMeta::setKeywords($category->meta_keywords);

            $url = '/' . $category->slug;
            OpenGraph::setTitle($category->title);
            OpenGraph::setUrl($url);
        }

    }

    public function updatingPage($page)
    {
        return redirect()->to('/articles?page=' . $page . '&category_id=' . $this->category);
    }

    public function updatingCategory($category)
    {
        $this->category = $category;
        $this->page = 1;
        $this->articles = Article::where('category_id', $this->category)->with('comments')->paginate($this->perPage);

        return redirect()->to('/articles?page=1' . '&category_id=' . $this->category);
    }
}
