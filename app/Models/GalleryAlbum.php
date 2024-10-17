<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GalleryAlbum extends Model
{
    use HasFactory;

    protected $table = 'gallery_album';

    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'description',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'user_id',

    ];

    public function gallery()
    {
        return $this->hasMany(Gallery::class, 'gallery_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getThumbnail()
    {
        return $this->thumbnail ? asset('storage/' . $this->thumbnail): asset('images/default.png');
    }
}
