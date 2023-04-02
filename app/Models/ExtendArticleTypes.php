<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtendArticleTypes extends Model
{
    use HasFactory;

    protected $table = 'extend_article_types';

    protected $fillable = ['id','article_id','name','value'];

    public $timestamps = false;

}
