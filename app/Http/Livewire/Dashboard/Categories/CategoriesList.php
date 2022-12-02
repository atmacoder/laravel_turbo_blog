<?php

namespace App\Http\Livewire\Dashboard\Categories;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class CategoriesList extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.dashboard.categories.categories-list', [
            'categories' => Category::where('parent_id', 0)->with(['subCategories' => function ($q) {
                return $q->with('categories');
            }])->paginate(10),

        ]);
    }

}
