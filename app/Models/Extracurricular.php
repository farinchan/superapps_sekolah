<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Extracurricular extends Model
{
    protected $table = 'extracurricular';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
