<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtendArticle extends Model
{
    use HasFactory;

    protected $table = 'extend_article';

    public $timestamps = false;

    public function article(){
        return $this->belongsTo(Article::class, 'article_id', 'id');
    }

    public function getDataAttribute($value){
        if($value) {
            try {
                return unserialize($value);
            }
            catch(\Exception $e){}
        }
        else{
            return null;
        }

    }

}
