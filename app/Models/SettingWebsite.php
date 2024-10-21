<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SettingWebsite extends Model
{
    use HasFactory;

    protected $table = 'setting_website';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getLogo(){
        return Storage::url($this->logo);
    }

    public function getFavicon(){
        return Storage::url($this->favicon);
    }

}
