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
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ArticleEdit extends Component
{
    public $article, $article_id, $categories, $title, $image, $description, $slug, $metadesc, $metakeys,$created_at, $image_name, $extendTypes;

    public $category_id = 1;
    public $images = [];
    public $new_images = [];
    public $selectedImg = [];

    protected $listeners = ['editArticle'];

    public function mount(Request $request)
    {

        $user = Auth::user();
        if (!$user->can('view_articles') || !$user->can('edit_articles')  ) {
            $this->skipRender();
            return redirect()->to('/no-permission');
        }
        //$this->extendedTypes = ExtendArticleTypes::all();
        $article = Article::with('extendTypes')->with('images')->find($request->input('article_id'));
        $this->article_id = $article->id;
        $this->article = $article;

        $this->category_id = $this->article->category_id;
        $this->categories = Category::all();
        $this->title = $this->article->title;
        $this->image = $this->article->image;
        $this->description = $this->article->description;
        $this->slug = $this->article->slug;
        $carbon_date = Carbon::parse($this->article->created_at);
        $formatted_date = $carbon_date->format('Y-m-d');
        $this->created_at = $formatted_date;
        $this->metadesc = $this->article->meta_description;
        $this->metakeys = $this->article->meta_keywords;

        //$this->extendTypes = $this->article->extendTypes->data[0];
        $this->extendTypes = ExtendArticleTypes::get();

        if ($this->article->extendTypes && $this->article->extendTypes->data) {
            foreach ($this->article->extendTypes->data as $key1 => $ext) {
                foreach ($this->extendTypes as $key2 => $ext2) {
                    if ($this->article->extendTypes->data[$key1]['id'] == $this->extendTypes[$key2]->id) {
                        $this->extendTypes[$key2]->value = $this->article->extendTypes->data[$key1]['value'];
                    }
                }
            }
        }

        $article = Article::find($this->article_id);

        $this->images = $article->getMedia($this->slug)->toArray();
		if(!$this->images){
			if($article->images && count($article->images)>0){
			$images = $article->getMedia($article->images[0]->collection_name); // Получить изображения со старым названием коллекции
			foreach ($images as $image) {
			$image->update([
			'collection_name' => $this->slug
				]);
			}
			$this->images = $article->getMedia($this->slug)->toArray();
				}

		}

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

    public function setImages($name)
    {
        array_push($this->new_images, $name);
    }

    public function setArticleMainImg($index)
    {

        $article = Article::find($this->article_id);
        $article->image = $this->images[$index]['original_url'];
        $article->update();

        $this->article->image = $article->image;

        return redirect()->to('/article-edit?article_id=' . $article->id);
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
        $user = Auth::user();

        if ($user->can('edit_articles')) {

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
            $article->created_at = $this->created_at;
            $article->description = $this->description;

            if ($article->slug != $this->slug) {
                $imgs = Image::where('collection_name', $article->slug);
                foreach ($imgs as $img) {
                    $img->collection_name = $this->slug;
                    $img->update();
                }
            }

            $article->slug = $this->slug;
            $article->meta_description = $this->metadesc;
            $article->meta_keywords = $this->metakeys;
            $article->update();

            //attach extendedTypes
            if ($this->extendTypes) {
                foreach ($this->extendTypes as $key => $type) {
                    if ($type->value) {
                        $extendTypes = Arr::add(['type' => $type->type], 'value', $type->value);
                    }
                }

                $ExtendArticle = ExtendArticle::where('article_id', $article->id)->first();
                $this->extendTypes = $this->extendTypes->toArray();

                if ($ExtendArticle) {
                    $ExtendArticle->data = serialize($this->extendTypes);
                    //$ExtendArticle->article_id = $article->id;
                    $ExtendArticle->update();

                } else {
                    $ExtendArticle = new ExtendArticle;
                    $ExtendArticle->article_id = $article->id;
                    $ExtendArticle->data = serialize($this->extendTypes);
                    $ExtendArticle->save();
                }


            }

            //attach images
            if (Count($this->new_images) > 0) {
                foreach ($this->new_images as $file) {
                    $article->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection($this->slug);
                }
            }
            return redirect()->to('/dashboard-articles')->with('status', __('main.article') . ' ' . $article->name . ' ' . __('main.updated'));
        } else {
            return redirect()->to('/no-permission');
        }
    }

    public function updatedImages()
    {
        $user = Auth::user();
        if ($user->can('edit_articles')) {
            if (Count($this->images) > 0) {
                foreach ($this->images as $image) {
                    $i = Image::find($image['id']);
                    $i->name = $image['name'];
                    $i->update();
                }
            }
        } else {
            return redirect()->to('/no-permission');
        }
    }

    public function updatedTitle()
    {
        $slug = SlugService::createSlug(Article::class, 'slug', $this->title, ['unique' => false]);
        $this->slug = $slug;
    }
    public function changeStatusPublished($article_id){

        $thisArticle = Article::with('category')->find($article_id);
        $thisArticle->published = !$thisArticle->published;
        $thisArticle->update();
        $this->article->published = $thisArticle->published;
        //return redirect()->to('/dashboard-articles?page' . $this->page . '&category_id=' . $thisArticle->category->id);
        // return redirect()->to('/comments?page=' . $this->page);
    }
    public function changeStatusArhive($article_id){

        $thisArticle = Article::with('category')->find($article_id);
        $thisArticle->arhive = !$thisArticle->arhive;
        $thisArticle->update();
        $this->article->arhive = $thisArticle->arhive;
        //return redirect()->to('/dashboard-articles?page' . $this->page . '&category_id=' . $thisArticle->category->id);
        // return redirect()->to('/comments?page=' . $this->page);
    }
    public function openModuleDeleteArticle($article){
        $this->emit('activateModalArticleDelete', $article);
    }
}
