<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Main extends Component
{
    protected $articles;

    public function render()
    {

        return view('livewire.main', [
            'articles' => $this->articles
        ]);
    }
}
