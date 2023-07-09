<?php

namespace App\Http\Livewire\Elements;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use \App\Models\Category;

class DeleteCategoryModal extends Component
{
    public $category_id,$category_title;

    protected $listeners = ['activateModalDelete'];

    public function render()
    {
        return view('livewire.elements.delete-category-modal');
    }
    public function mount(){
        $user = Auth::user();
        if (!$user->can('delete_categories')) {
            $this->skipRender();
            return redirect()->to('/no-permission');
        }
    }
    public function activateModalDelete($cat){
        $this->category_id = $cat['id'];
        $this->category_title = $cat['title'];
    }
    public function deleteCategory($id){
        Category::find($id)->delete();
        return redirect()->to('/сategories')->with('status', __('main.category').' '.$this->category_title .' '.__('main.deleted'));;
    }
}
