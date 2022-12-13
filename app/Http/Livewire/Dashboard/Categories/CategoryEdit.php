<?php

namespace App\Http\Livewire\Dashboard\Categories;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Category;

class CategoryEdit extends Component
{
    public $category, $categories, $title, $description, $slug, $metadesc, $metakeys, $image_name;

    public $category_id = 0;

    protected $listeners = ['editCategory'];

    public function mount(Request $request)
    {
        $category = Category::find($request->input('category_id'));
        $this->category_id = $category->parent_id;
        $this->category =  $category;
        $this->categories = Category::all();
        $this->title = $this->category->title;
        $this->description = $this->category->description;
        $this->slug = $this->category->slug;
        $this->metadesc = $this->category->meta_description;
        $this->metakeys = $this->category->meta_keywords;
    }

    public function render()
    {
        return view('livewire.dashboard.categories.category-edit');
    }

    public function editCategory($category_id)
    {
        $this->category = \App\Models\Category::find($category_id);
    }
    public function updateCategory(){

        $this->validate([
            'title' => 'required',
            'description' => 'required',
            'slug' => 'required',
        ]);

        $category = Category::find($this->category_id);
        $category->description = $this->description;
        $category->title = $this->title;
        $category->slug = $this->slug;
        $category->metadesc = $this->metadesc;
        $category->metakeys = $this->metakeys;

        if($this->category_id) {
            $category->parent_id = $this->category_id;
        }

        $category->update();
    }

}
