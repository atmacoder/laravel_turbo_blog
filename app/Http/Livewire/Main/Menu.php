<?php

namespace App\Http\Livewire\Main;

use App\Models\Settings;
use Livewire\Component;
use App\Models\MenuItem;
use App\Models\Category;
use App\Models\Article;

class Menu extends Component
{
    public $active;
    public $settings;

    public function render()
    {
        $menuItems = MenuItem::orderBy('order')
            ->with(['category', 'articles'])
            ->get();

        return view('livewire.main.menu', [
            'menuItems' => $menuItems,
            'settings' => $this->settings, // Pass settings to the view
        ]);
    }

    public function mount()
    {
        $this->active = request()->path();
        $this->settings = Settings::first();
    }
}
