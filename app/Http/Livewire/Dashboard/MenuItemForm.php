<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\MenuItem;
use App\Models\Category;
use Livewire\Component;

class MenuItemForm extends Component
{
    public $category_ids;
    public $menuItem;
    public $name;
    public $type;
    public $categories;

    protected $listeners = ['editMenuItem' => 'loadMenuItem'];

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function render()
    {
        return view('livewire.dashboard.menu-item-form');
    }

    public function loadMenuItem(MenuItem $menuItem)
    {
        if ($this->name === 'dashboard.menu-item-form') {
            $this->menuItem = $menuItem;

            $this->name = $menuItem->name;
            $this->type = $menuItem->type;
            $this->category_ids = $menuItem->categories->pluck('id')->toArray();

            $this->editing = true;
        }
    }

    public function update()
    {
        $this->validate();

        // Update the menu item in the database
        $this->menuItem->update([
            'name' => $this->name,
            'type' => $this->type,
        ]);

        if ($this->type === 'category-group') {
            $this->menuItem->categories()->sync($this->category_ids);
        }

        // Emit an event to the parent component to indicate that the menu item has been updated
        $this->emit('menuItemUpdated');
    }

    public function delete()
    {
        $this->menuItem->delete();

        $this->emit('menuItemDeleted');
    }
}
