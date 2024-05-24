<?php

namespace App\Http\Livewire\Main\Articles;

use http\Env\Response;
use Illuminate\Http\Request;
use Livewire\Component;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
class ArticleFull extends Component
{
    public function render()
    {
        return view('livewire.main.articles.article-full');
    }
    public function  mount(Request $request, $article_slug,$category_slug){

        $article = \App\Models\Article::with(['comments' => function ($query) { $query->where('published', true); }])->with('images')->where('slug', $article_slug)->first();

        if (!$article) {
            $similarity_threshold = 0.1;
            $cacheKey = "article_similarity_{$article_slug}";
            $similar_articles = Cache::remember($cacheKey, 60, function () use($article_slug){
                return \App\Models\Article::with(['comments' => function($query) { $query->where('published', true); }])->with('images')->where('slug','like', '%'.$article_slug.'%')->get();
            });

            foreach ($similar_articles as $similar_article) {
                $similarity = DB::selectOne("SELECT levenshtein('{$article_slug}', '{$similar_article->slug}') AS similarity");
                $similarity = $similarity->similarity / max(strlen($article_slug), strlen($similar_article->slug));
                if ($similarity >= $similarity_threshold) {
                    $article = $similar_article;
                    break;
                }
            }
        }

        if (!$article) {
            return redirect()->route('404');
        }

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

    protected $listeners = ['openModuleDeleteArticle'];
    public function openModuleDeleteArticle($articleId)
    {
        // Получаем статью по идентификатору
        $article = Article::find($articleId);

        // Вызываем событие, передавая статью
        $this->emit('activateModalArticleDelete', $article);
    }
}
