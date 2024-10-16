<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingWebsite extends Model
{
    use HasFactory;

    protected $table = 'setting_website';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    
}
