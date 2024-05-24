<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = ['name', 'category_id', 'is_divider', 'order'];

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
        return $this->belongsToMany(Category::class);
    }
}
