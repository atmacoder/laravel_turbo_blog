<?php

namespace App\Http\Livewire\Dashboard\Categories;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CategoryItem extends Component
{
    public $category;

    public function render()
    {
        return view('livewire.dashboard.categories.category-item');
    }

    public function openModuleDeleteCategory($category){
        $this->emit('activateModalDelete', $category);
    }
    public function editCategory($id){
        $this->emit('editCategory', $id);
        return redirect()->route('category_edit', ['category_id'=> $id]);
    }
    public function mount(){
        $user = Auth::user();
        if (!$user->can('view_categories') || !$user->can('edit_categories')) {
            $this->skipRender();
            return redirect()->to('/no-permission');
        }
    }
}
