<?php

namespace App\Http\Livewire\Dashboard\Articles;

use Livewire\Component;
use App\Models\Article;
use App\Models\Category;
use App\Models\ExtendArticleTypes;
use App\Models\ExtendArticle;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Arr;

class ArticleCreate extends Component
{
    use AuthorizesRequests;

    public $title,$description,$slug,$metadesc,$metakeys,$categories,$category_id,$extendedTypes;

    public $images = [];

    protected $rules = [
        'images' => 'required',
        'extendedTypes.*.value' => '',
    ];
    public function render()
    {
        return view('livewire.dashboard.articles.create-article');
    }

    public function mount(){

        $user = Auth::user();

        if (!$user->can('view_articles') || !$user->can('create_articles')  ) {
            $this->skipRender();
            return redirect()->to('/no-permission');
        }

        $categories = Category::all();
        $this->extendedTypes = ExtendArticleTypes::get();
        $this->categories = $categories;
        if(!Count($this->categories)){
            return redirect()->to('/add-category')->with('status',__('main.create_category_first'));
        }
    }
    public function setImages($name){
        array_push($this->images ,$name);
    }
    public function createArticle()
    {
        $user = auth::user();

        $this->validate([
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'slug' => 'required',
        ]);
        if ($user->can('create_articles')) {
        $extendTypes = $this->extendedTypes;
        $extendTypes = $extendTypes->toArray();

        if($this->extendedTypes) {
            foreach ($this->extendedTypes as $key => $type) {
                if ($type->value == null) {
                    unset($extendTypes[$key]);
                }
            }
        }

        $project = Article::create(
            [
                'title' => $this->title,
                'description' => $this->description,
                'category_id' => $this->category_id,
                'slug' => $this->slug,
                'user_id' => $user->id,
                'meta_description' => $this->metadesc,
                'meta_keywords' => $this->metakeys,
            ]
        );

        if($extendTypes){
            $ExtendArticle = new ExtendArticle;
            $ExtendArticle->data = serialize($extendTypes);
            $ExtendArticle->article_id = $project->id;
            $ExtendArticle->save();
        }

        //attach images
        if(Count($this->images)>0) {
            foreach ($this->images as $file) {
                $project->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection($this->slug);
            }

            $images = $project->getMedia($this->slug);
            $project->image = $images[0]->original_url;
            $project->update();

        }

        return redirect()->to('article-edit?article_id=' . $project->id)->with('status',__('main.article') . ' ' . $this->title . ' ' . __('main.created'));
        } else {
            return redirect()->to('/no-permission');
        }
        }
    public function updatedTitle()
    {
        $slug = SlugService::createSlug(Category::class, 'slug', $this->title, ['unique' => false]);
        $this->slug = $slug;
    }
}
