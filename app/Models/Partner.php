<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{

    protected $table = 'partner';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
