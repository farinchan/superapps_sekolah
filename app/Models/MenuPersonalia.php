<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuPersonalia extends Model
{
    protected $table = 'menu_personalia';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
