<?php

namespace App\Http\Livewire\Elements;
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
        //$this->category_id = 1;
        //$this->category_name = '123';
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
