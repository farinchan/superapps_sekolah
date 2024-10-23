<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Extracurricular extends Model
{
    protected $table = 'extracurricular';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getLogo(){
        return Storage::url($this->image);
    }
}
