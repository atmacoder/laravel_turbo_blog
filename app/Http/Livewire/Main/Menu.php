<?php

namespace App\Http\Livewire\Main;

use App\Models\Settings;
use Livewire\Component;
use App\Models\MenuItem;

class Menu extends Component
{
    public $active;
    public $settings;

    public function render()
    {
        $menuItems = MenuItem::orderBy('order')->with('category')->get();

        return view('livewire.main.menu', [
            'menuItems' => $menuItems,
        ]);
    }

    public function mount()
    {
        $this->active = request()->path();
        $this->settings = Settings::first();
    }

}
