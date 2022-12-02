<?php

namespace App\Http\Livewire\Dashboard\Articles;

use Livewire\Component;
use App\Models\Article;
use App\Models\Category;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CreateArticle extends Component
{
    use AuthorizesRequests;

    public $title,$description,$slug,$metadesc,$metakeys,$categories,$category_id;

    public $images = [];

    protected $rules = [
        'images' => 'required',
    ];
    public function render()
    {
        return view('livewire.dashboard.articles.create-article');
    }

    public function mount(){
        $this->categories = Category::all();
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

        //attach images
        if(Count($this->images)>0) {
            foreach ($this->images as $file) {
                $project->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection($this->slug);
            }
        }

        $images = $project->getMedia($this->slug);

        $project->image = $images[0]->original_url;
        $project->update();

        return redirect()->to('http://turbo.ru/article-edit?article_id=' . $project->id)->with('status',__('main.article') . $this->title .__('main.created'));
    }
    public function updatedTitle()
    {
        $slug = SlugService::createSlug(Category::class, 'slug', $this->title, ['unique' => false]);
        $this->slug = $slug;
    }
}
