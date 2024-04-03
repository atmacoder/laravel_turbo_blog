<?php

namespace App\Http\Livewire\Main\Articles;

use Illuminate\Http\Request;
use Livewire\Component;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
class ArticleFull extends Component
{
    public function render()
    {
        return view('livewire.main.articles.article-full');
    }
    public function  mount(Request $request, $article_slug,$category_slug){
        
        $article = \App\Models\Article::with(['comments' => function($query) { $query->where('published', true); }])->with('images')->where('slug',$article_slug)->first();
        $this->article = $article;


        $category = \App\Models\Category::where('slug',$category_slug)->first();
        $this->category = $category;

        SEOTools::setTitle($this->article->title);
        SEOTools::setDescription($this->article->meta_description);
        SEOMeta::setKeywords($this->article->meta_keywords);

        $url = '/' . $this->category->slug .'/' .$this->article->slug;
        OpenGraph::setTitle($this->article->title);
        OpenGraph::setUrl($url);
        OpenGraph::addProperty('type', 'articles');
        OpenGraph::addImage($this->article->image);
        //SEOTools::twitter()->setSite('@LuizVinicius73');
        SEOTools::jsonLd()->addImage($this->article->image);
    }
}
