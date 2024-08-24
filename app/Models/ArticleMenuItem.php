<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
class ArticleMenuItem extends Pivot
{
    use HasFactory;

    // In App/Models/Article.php
    public function menuItems()
    {
        return $this->belongsToMany(MenuItem::class, 'article_menu_item');
    }

// In App/Models/MenuItem.php
    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_menu_item');
    }
}
