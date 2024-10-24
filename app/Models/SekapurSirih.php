<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SekapurSirih extends Model
{
    protected $table = 'sekapur_sirih';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getImage()
    {
        return Storage::url($this->image);
    }
}
