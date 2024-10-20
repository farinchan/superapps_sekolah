<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Extracurricular extends Model
{
    protected $table = 'extracurricular';
    protected $fillable = ['name', 'slug', 'description', 'image'];
}
