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

class UploadController extends Controller
{
    public  function uploadImg(Request $request)
    {
        $path = storage_path('tmp\uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function uploadContent(Request $request){

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
                'category_id' =>1,
                'slug' => $slug,
                'user_id' => $user->id,
                'meta_description' => $request->input('description'),
                'meta_keywords' => $request->input('keywords'),
            ]
        );

        $project->addMedia(storage_path('tmp\uploads\\' . $request->input('photo')))->toMediaCollection($slug);

            $image = $project->getMedia($slug);
            $project->image = $image[0]->original_url;
            $project->update();

        return "created";
    }
}
