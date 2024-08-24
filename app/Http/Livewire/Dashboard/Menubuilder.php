<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Category;
use App\Models\MenuItem;
use App\Models\CategoryMenuItem;
use App\Models\Article;
use App\Models\ArticleMenuItem;
use Livewire\Component;

class Menubuilder extends Component
{
    public $menuItems;
    public $categories;
    public $articles;
    public $menuItem;
    public $name;
    public $type;
    public $parent_id;
    public $category_id;
    public $url = '';


    public $editing = false;
    public $category_ids = [];
    public $article_ids = [];

    public function mount()
    {
        $this->categories = Category::all();
        $this->menuItems = MenuItem::all();
        $this->menuItem = new MenuItem();
        $this->articles = Article::all();
    }

    public function render()
    {
        return view('livewire.dashboard.menubuilder', [
            'category_ids' => $this->category_ids,
            'article_ids' => $this->article_ids,
        ]);
    }

    public function save()
    {
        try {
            // Set the type before validation
            if ($this->editing) {
                $this->menuItem->type = $this->type;
            } else {
                $this->menuItem->type = $this->type;
            }

            $validatedData = $this->validate([
                'name' => 'required|string',
                'type' => 'required|string',
                'category_ids' => 'nullable|array',
                'article_ids' => 'nullable|array',
                'url' => 'nullable|string',
            ]);

            if ($this->editing) {
                // Update existing MenuItem
                $this->menuItem->update($validatedData);
            } else {
                // Create new MenuItem
                $menuItem = MenuItem::create([
                    'name' => $validatedData['name'],
                    'type' => $validatedData['type'],
                    'url' => $validatedData['url'],
                ]);

                // Associate categories (if applicable)
                if ($validatedData['type'] === 'category-group') {
                    foreach ($validatedData['category_ids'] as $category_id) {
                        CategoryMenuItem::create([
                            'menu_item_id' => $menuItem->id,
                            'category_id' => $category_id,
                        ]);
                    }
                }

                // Associate articles (if applicable)
                if ($validatedData['type'] === 'article-group') {
                    foreach ($validatedData['article_ids'] as $article_id) {
                        ArticleMenuItem::create([
                            'menu_item_id' => $menuItem->id,
                            'article_id' => $article_id,
                        ]);
                    }
                }
            }

            $this->menuItems = MenuItem::all();
            $this->reset('name', 'type', 'category_id', 'parent_id', 'article_ids', 'category_ids');
            $this->editing = false;

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function edit($id)
    {
        $this->menuItem = MenuItem::find($id);
        $this->name = $this->menuItem->name;
        $this->type = $this->menuItem->type;
        $this->category_ids = $this->menuItem->categories->pluck('id')->toArray();
        $this->article_ids = $this->menuItem->articles->pluck('id')->toArray();
        $this->editing = true;

        // Pass data to the editMenuItem event as an array
        $this->emit('editMenuItem', $this->menuItem->id, $this->category_ids, $this->article_ids);
    }

    public function cancel()
    {
        $this->editing = false;
        $this->menuItem = new MenuItem();
        $this->reset('name', 'type', 'category_id', 'parent_id', 'article_ids', 'category_ids');
    }

    protected $listeners = [
        'menuItemDeleted' => 'refreshMenuItems',
        'editMenuItem' => 'loadMenuItem',
        'menuItemUpdated' => 'refreshMenuItems',
    ];

    public function refreshMenuItems()
    {
        $this->menuItems = MenuItem::all();
    }

    public function loadMenuItem($id, array $category_ids, array $article_ids)
    {
        $this->menuItem = MenuItem::find($id);
        $this->name = $this->menuItem->name;
        $this->type = $this->menuItem->type;
        $this->category_ids = $category_ids;
        $this->article_ids = $article_ids;
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

        // Refresh menuItems only after deleting
        $this->menuItems = MenuItem::all();
        $this->reset('category_ids', 'article_ids'); // Reset after deleting

        $this->emit('menuItemDeleted');
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'type' => 'required|string',
            'category_ids' => 'nullable|array',
            'article_ids' => 'nullable|array',
            'url' => 'nullable|string',
        ];
    }

}
