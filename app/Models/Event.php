<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{

    use HasFactory;

    protected $table = 'event';
    protected $fillable = [
        'title',
        'content',
        'image',
        'slug',
        'is_active',
        'start',
        'end',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getImage()
    {
        return $this->image ? Storage::url($this->image) : asset('back/media/svg/files/blank-image.svg');
    }
}
