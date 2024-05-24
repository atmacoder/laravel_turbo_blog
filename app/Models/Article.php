<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Article extends Model implements HasMedia
{
    use HasFactory;
    use Sluggable;
    use InteractsWithMedia;

    protected $table = 'articles';

    protected $fillable = [
        'title',
        'description',
        'slug',
        'category_id',
        'user_id',
        'meta_description',
        'meta_keywords'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function images(){
        return $this->hasMany(Image::class, 'model_id', 'id');
    }
    public function comments(){
        return $this->hasMany(Comment::class, 'article_id', 'id');
    }
    public function category(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    public function extendTypes(){
        return $this->hasOne(ExtendArticle::class, 'article_id', 'id');
    }
}
