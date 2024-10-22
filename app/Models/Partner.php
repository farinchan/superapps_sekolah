<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Partner extends Model
{

    protected $table = 'partner';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getLogo(){
        return Storage::url($this->logo);
    }
}
