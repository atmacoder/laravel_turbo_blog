<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\MenuItem;
use App\Models\Category;
use App\Models\Article;
use Livewire\Component;

class MenuItemForm extends Component
{
    public $menuItem;
    public $name;
    public $type;
    public $category_ids = [];
    public $article_ids = [];
    public $url; // Add the url property
    public $categories;
    public $articles;
    public $menuItems;
    public $editing = false;

    public function mount()
    {
        $this->categories = Category::all();
        $this->articles = Article::all();
        $this->menuItems = MenuItem::all();
    }

    public function render()
    {
        return view('livewire.dashboard.menu-item-form', [
            'categories' => $this->categories,
            'articles' => $this->articles,
            'menuItems' => $this->menuItems,
        ]);
    }

    protected $listeners = ['editMenuItem' => 'loadMenuItem'];

    public function loadMenuItem($id, array $category_ids, array $article_ids)
    {
        $this->menuItem = MenuItem::find($id);
        $this->name = $this->menuItem->name;
        $this->type = $this->menuItem->type;
        $this->category_ids = $category_ids;
        $this->article_ids = $article_ids;
        $this->url = $this->menuItem->url; // Load the url from the MenuItem
        $this->editing = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string',
            'type' => 'required|string',
            'category_ids' => 'nullable|array',
            'article_ids' => 'nullable|array',
            'url' => 'nullable|string',
        ]);

        $this->menuItem->update([
            'name' => $this->name,
            'type' => $this->type,
            'url' => $this->url, // Update the URL
        ]);

        if ($this->type === 'category-group') {
            $this->menuItem->categories()->sync($this->category_ids);
        } else if ($this->type === 'article-group') {
            $this->menuItem->articles()->sync($this->article_ids);
        }

        $this->emit('menuItemUpdated');

        $this->editing = false;
    }

    public function delete()
    {
        $this->menuItem->delete();

        $this->emit('menuItemDeleted');
    }
}
