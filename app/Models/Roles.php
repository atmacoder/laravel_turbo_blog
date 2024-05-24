<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Contracts\Permission;

class Roles extends Model
{
    use HasFactory;


    protected $table = 'roles';

    protected $fillable = [
        'name',
        'guard_name',
    ];
}
