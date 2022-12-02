<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Category;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;
use mysql_xdevapi\Exception;
use Nette\Schema\ValidationException;

class Images extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    

    public function render()
    {

        return view('livewire.dashboard.images', [
            'images' => \App\Models\Image::paginate(10)
        ]);
    }

}
