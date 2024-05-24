<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Article;
use App\Models\Category;
use App\Models\ExtendArticleTypes;
use App\Models\ExtendArticle;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\UploadedFile;

class UploadController extends Controller
{
    public function uploadImg(Request $request)
    {
        $path = storage_path('tmp\uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name' => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function uploadContent(Request $request)
    {

        $user = auth::user();

        $request->validate([
            'h1' => 'required',
            'content' => 'required',
        ]);

        $slug = SlugService::createSlug(Category::class, 'slug', $request->input('h1'), ['unique' => false]);

        $project = Article::create(
            [
                'title' => $request->input('h1'),
                'description' => $request->input('content'),
                'category_id' => 1,
                'slug' => $slug,
                'user_id' => $user->id,
                'meta_description' => $request->input('description'),
                'meta_keywords' => $request->input('keywords'),
            ]
        );

        $project->addMedia(storage_path('tmp\uploads\\' . $request->input('photo')))->toMediaCollection($project->slug);

        $image = $project->getMedia($project->slug);
        $project->image = $image[0]->original_url;
        $project->update();

        return "created";
    }

    public function createCategory(Request $request)
    {
        //validation

        /*        $this->validate([
                    'title' => 'required',
                    'description' => 'required',
                    'slug' => 'required',
                ]);*/

        $new_category = new Category;
        $new_category->title = $request->name;
        $new_category->slug = $request->url;
        if ($request->description) {
            $new_category->description = $request->description;
        }
        $new_category->meta_description = $request->meta_description;
        $new_category->meta_keywords = $request->meta_keys;
        $new_category->parent_id = 0;

        $new_category->save();

        Permission::create([
            'name' => 'create_' . $new_category->slug
        ]);
        Permission::create([
            'name' => 'view_' . $new_category->slug
        ]);
        Permission::create([
            'name' => 'delete_' . $new_category->slug
        ]);
        Permission::create([
            'name' => 'edit_' . $new_category->slug
        ]);

        return "created";
    }

    public function createArticle(Request $request)
    {
        $user = auth::user();

        if ($user->can('create_articles')) {

            $category = \App\Models\Category::where('slug', $request->category['url'])->first();




            $article = new \App\Models\Article;

            $article->title = $request->name;
            $article->description = $request->description;
            $article->image = "/images/" .$request->image;
            $article->published = $request->enabled;
            $article->arhive = $request->arhive;
            $article->category_id = $category->id;
            $article->user_id = $user->id;
            $article->meta_description = $request->meta_description;
            $article->meta_keywords = $request->meta_keys;
            $article->save();

            $ext1 = ExtendArticleTypes::where('name', 'Краткое описание')->first();

            $my_collection = collect();

            $my_collection->push(
                [
                    'id' => $ext1->id,
                    'name' => $ext1->name,
                    'type' => $ext1->type,
                    'value' => $request->short_description
                ]
            );

            if (Count($my_collection->all()) > 0) {
                $ExtendArticle = new ExtendArticle;
                $ExtendArticle->data = serialize($my_collection->all());
                $ExtendArticle->article_id = $article->id;
                $ExtendArticle->save();
            }

            // Проверка существования коллекции носителей
            if ($article->getMedia($request->url)->count() == 0) {
                $article->addMediaCollection($request->url);
            }

            // Добавление изображений
            foreach ($request->images as $image) {
                $path = storage_path("app\public\images\gallery\\" . $request->url . "\\" . $image['image']);
                $file = new UploadedFile($path, $image['image'], 'image/jpeg', null, true); // Assuming it's a JPEG file

                try {
                    $media = $article->addMedia($file)->toMediaCollection($request->url);
                    $media->setCustomProperty('description', $image['description']);
                } catch (Exception $e) {
                    // Обработка исключения
                }
            }
        }
    }
    public function updateCollectionNames()
    {
        $articles = \App\Models\Article::with('images')->get();

        foreach ($articles as $article) {
            $collectionName = $article->slug;

            foreach ($article->images as $image) {
                $image->collection_name = $collectionName;
                $image->save(); // Добавлено
            }
        }

        return response()->json(['success' => true]);
    }
}
