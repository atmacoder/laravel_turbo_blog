<?php

namespace App\Http\Livewire\Dashboard\Categories;

use Livewire\Component;
use App\Models\Category;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class CreateCategory extends Component
{
    use AuthorizesRequests;

    public $title, $categories, $description, $slug, $metadesc, $metakeys;

    public $category_id = 0;

    public function render()
    {
        return view('livewire.dashboard.categories.create-category');
    }

    public function mount()
    {
        $user = Auth::user();

        if (!$user->can('view_categories') || !$user->can('create_categories')) {
            $this->skipRender();
            return redirect()->to('/no-permission');
        }

        $this->categories = Category::all();
    }

    public function createCategory()
    {
        //validation

        $this->validate([
            'title' => 'required',
            'description' => 'required',
            'slug' => 'required',
        ]);

        $new_category = new Category;
        $new_category->title = $this->title;
        $new_category->slug = $this->slug;


        $new_category->parent_id = $this->category_id;


        if ($this->description) {
            $new_category->description = $this->description;
        }

        if ($this->metadesc) {
            $new_category->meta_description = $this->metadesc;
        }
        if ($this->metakeys) {
            $new_category->meta_keywords = $this->metakeys;
        }

        $new_category->save();

        Permission::create([
            'name' => 'create_'.$new_category->slug
        ]);
        Permission::create([
            'name' => 'view_'.$new_category->slug
        ]);
        Permission::create([
            'name' => 'delete_'.$new_category->slug
        ]);
        Permission::create([
            'name' => 'edit_'.$new_category->slug
        ]);

        return redirect()->to('/сategories')->with('status', __('main.category') . ' ' . $new_category->title . ' ' . __('main.category_was_created'));
    }

    public function updatedTitle()
    {
        $slug = SlugService::createSlug(Category::class, 'slug', $this->title, ['unique' => false]);
        $this->slug = $slug;
    }
}
