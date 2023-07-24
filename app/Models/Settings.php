<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    public $timestamps = false;

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
