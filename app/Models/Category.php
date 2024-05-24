<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use HasFactory;
    use Sluggable;

    protected $table = 'categories';

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $fillable = [
        'title',
        'description',
        'slug',
        'image_url',
        'meta_keywords',
        'meta_description'
    ];

    public function Categories()
    {
        return $this->hasMany(Category::class,'parent_id','id');
    }
    public function SubCategories()
    {
        return $this->hasMany(Category::class,'parent_id','id')->with('categories');
    }
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
