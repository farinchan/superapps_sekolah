<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SettingBanner extends Model
{
    use HasFactory;

    protected $table = 'setting_banner';
    protected $fillable = ['title', 'subtitle', 'image', 'url', 'status'];

    public function getImage()
    {
        return $this->image ? Storage::url($this->image) : asset('images/default.png');
    }
    
}
