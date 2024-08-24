<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'parent_id', 'type', 'url', 'is_divider', 'order'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_menu_item'); // Correct pivot table name
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_menu_item');
    }
}
