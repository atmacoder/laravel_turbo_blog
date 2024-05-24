<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Category;
use App\Models\MenuItem;
use App\Models\CategoryMenuItem;
use Livewire\Component;

class Menubuilder extends Component
{
    public $menuItems;
    public $categories;
    public $menuItem;
    public $name;
    public $type;
    public $parent_id;
    public $category_id;
    public $editing = false;
    public $category_ids = [];

    public function mount()
    {
        $this->categories = Category::all();
        $this->menuItems = MenuItem::all();
        $this->menuItem = new MenuItem();
    }

    public function render()
    {
        return view('livewire.dashboard.menubuilder', [
            'category_ids' => $this->category_ids,
        ]);
    }

    public function save()
    {
        try {
            if ($this->editing) {
                $this->menuItem->update($this->validate());
            } else {
                $this->menuItem->type = $this->type; // Set the type before saving

                if ($this->type === 'category') {
                    $menuItem = new MenuItem(); // Create a new MenuItem instance
                    $menuItem->name = $this->name; // Set the name
                    $menuItem->type = $this->type; // Set the type
                    $menuItem->category_id = $this->category_ids[0]; // Set the category ID
                    $menuItem->save(); // Save the new menu item
                } else if ($this->type === 'category-group') {
                    $menuItem = MenuItem::create([
                        'name' => $this->name, // Set the name before saving
                        'type' => 'category-group',
                    ]);

                    foreach ($this->category_ids as $category_id) {
                        CategoryMenuItem::create([
                            'menu_item_id' => $menuItem->id,
                            'category_id' => $category_id,
                        ]);
                    }
                } else {
                    $this->menuItem->name = $this->name; // Set the name before saving
                    $this->menuItem->save(); // Save the individual menu item
                }
            }

            $this->menuItems = MenuItem::all();
            $this->reset('name', 'type', 'category_id', 'parent_id');
        } catch (\Exception $e) {
            dd($e->getMessage()); // Display the error message for debugging
        }
    }
    public function edit($id)
    {
        $menuItem = MenuItem::find($id);

        $this->emit('editMenuItem', $menuItem);
        //$this->editing = true;
    }

    public function cancel()
    {
        $this->editing = false;
        $this->menuItem = new MenuItem();
    }

    protected $listeners = [
        'menuItemDeleted' => 'refreshMenuItems',
        'editMenuItem' => 'loadMenuItem'
    ];

    public function refreshMenuItems()
    {
        $this->menuItems = MenuItem::all();
    }
    public function loadMenuItem(MenuItem $menuItem)
    {
        $this->menuItem = $menuItem;
        $this->name = $menuItem->name;
        $this->type = $menuItem->type;
        $this->category_ids = $menuItem->categories->pluck('id')->toArray();
        $this->editing = true;
    }
    public function updatedMenuItem()
    {
        // Refresh the menu items list
        $this->menuItems = MenuItem::all();

        // Reset the editing state
        $this->editing = false;
    }
    public function delete($id)
    {
        $menuItem = MenuItem::find($id);
        $menuItem->delete();

        $this->emit('menuItemDeleted');
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'type' => 'required|string',
            'category_ids' => 'nullable|array',
        ];
    }

}
