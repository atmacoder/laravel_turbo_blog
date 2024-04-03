<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class FileUploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public  function dashboard_images(Request $request)
    {
        $path = storage_path('tmp/uploads');

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
    /**
     * File Upload Method
     *
     * @return void
     */
    public  function dropzoneFileUpload(Request $request)
    {

/*        $project = \App\Models\Image::create($request->all());

        foreach ($request->input('document', []) as $file) {
            $project->addMedia(storage_path('tmp\uploads\\' . $file))->toMediaCollection('document');
        }*/

        return redirect()->route('dashboard.images');

    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        $project->update($request->all());

        if (count($project->document) > 0) {
            foreach ($project->document as $media) {
                if (!in_array($media->file_name, $request->input('document', []))) {
                    $media->delete();
                }
            }
        }

        $media = $project->document->pluck('file_name')->toArray();

        foreach ($request->input('document', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $project->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('document');
            }
        }

        return redirect()->route('dashboard.images');
    }
}
