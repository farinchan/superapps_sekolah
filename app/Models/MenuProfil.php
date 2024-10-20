<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuProfil extends Model
{
    protected $table = 'menu_profil';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
