<?php

namespace App\Http\Livewire\Elements;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;
use \App\Models\Article;
class SearchBar extends Component
{

    use AuthorizesRequests;
    use WithPagination;

    public $query = null;

    public function render()
    {
        return view('livewire.elements.search-bar');
    }
    public function search()
    {
        return redirect()->route('searchResults', ['q' => $this->query]);
    }
}
