<?php

namespace App\Http\Livewire\Dashboard\Articles;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Arr;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use App\Models\Image;
use App\Models\ExtendArticleTypes;
use App\Models\ExtendArticle;

class ArticleEdit extends Component
{
    public $article, $article_id, $categories, $title, $image, $description, $slug, $metadesc, $metakeys, $image_name, $extendTypes;

    public $category_id = 1;
    public $images = [];
    public $new_images = [];
    public $selectedImg = [];

    protected $listeners = ['editArticle'];

    public function mount(Request $request)
    {
        //$this->extendedTypes = ExtendArticleTypes::all();
        $article = Article::with('extendTypes')->find($request->input('article_id'));
        $this->article_id = $article->id;
        $this->article = $article;

        $this->category_id = $this->article->category_id;
        $this->categories = Category::all();
        $this->title = $this->article->title;
        $this->image = $this->article->image;
        $this->description = $this->article->description;
        $this->slug = $this->article->slug;
        $this->metadesc = $this->article->meta_description;
        $this->metakeys = $this->article->meta_keywords;

        //$this->extendTypes = $this->article->extendTypes->data[0];
        $this->extendTypes = ExtendArticleTypes::get();

        if($this->article->extendTypes && $this->article->extendTypes->data){
            foreach($this->article->extendTypes->data as $key1 => $ext){
                foreach ($this->extendTypes as $key2 => $ext2){
                    if($this->article->extendTypes->data[$key1]['id'] == $this->extendTypes[$key2]->id){
                        $this->extendTypes[$key2]->value = $this->article->extendTypes->data[$key1]['value'];
                    }
                }
            }
        }

        $article = Article::find($this->article_id);

        $this->images = $article->getMedia($this->slug)->toArray();

    }

    public function rules()
    {
        return [
            'images.*.name' => 'required|max:255',
            'extendTypes.*.value' => 'required|max:255',
        ];
    }

    public function render()
    {


        return view('livewire.dashboard.articles.article-edit');
    }

    public function editArticle($article_id)
    {
        $this->article = Article::with('ExtendedTypes')->find($article_id);
    }

    public function setImages($name){
        array_push($this->new_images ,$name);
    }

    public function setArticleMainImg($index)
    {

        $article = Article::find($this->article_id);
        $article->image = $this->images[$index]['original_url'];
        $article->update();

        $this->article->image = $article->image;

        return redirect()->to('/article-edit?article_id='.$article->id);
    }
    public function deleteImage($index)
    {

        $imageToDelete_id = $this->images[$index]['id'];
        $imageToDelete = Image::find($imageToDelete_id);
        $imageToDelete->delete();

        $article = Article::find($this->article_id);
        $this->images = $article->getMedia($this->slug)->toArray();

    }

    public function updateArticle()
    {

        $this->validate([
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'slug' => 'required',
        ]);
        $category = Category::findOrFail($this->category_id);
        //$user = auth::user();
        //$user->hasPermissionTo('publish articles', 'admin');

        $article = Article::with('extendTypes')->find($this->article_id);

        $article->category_id = $this->category_id;
        $article->title = $this->title;
        $article->description = $this->description;

        if($article->slug != $this->slug){
            $imgs = Image::where('collection_name',$article->slug);
            foreach($imgs as $img){
                $img->collection_name = $this->slug;
                $img->update();
            }
        }

        $article->slug = $this->slug;
        $article->meta_description = $this->metadesc;
        $article->meta_keywords = $this->metakeys;
        $article->update();

        //attach extendedTypes
        if($this->extendTypes) {
            foreach ($this->extendTypes as $key =>$type) {
                if($type->value){
                    $extendTypes = Arr::add(['type' => $type->type], 'value', $type->value);
                }
            }

            $ExtendArticle = ExtendArticle::where('article_id',$article->id)->first();
            $ExtendArticle->data = serialize($this->extendTypes);
            //$ExtendArticle->article_id = $article->id;
            $ExtendArticle->update();
        }

        //attach images
        if(Count($this->new_images)>0) {
            foreach ($this->new_images as $file) {
                $article->addMedia(storage_path('tmp\uploads\\' . $file))->toMediaCollection($this->slug);
            }
        }
        return redirect()->to('/articles')->with('status', __('main.article') . ' ' . $article->name . ' ' . __('main.updated'));
    }

    public function updatedImages()
    {
        if (Count($this->images) > 0) {
            foreach ($this->images as $image) {
                $i = Image::find($image['id']);
                $i->name = $image['name'];
                $i->update();
            }
        }
    }

    public function updatedTitle()
    {
        $slug = SlugService::createSlug(Article::class, 'slug', $this->title, ['unique' => false]);
        $this->slug = $slug;
    }
}
