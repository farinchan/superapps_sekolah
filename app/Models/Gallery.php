<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'gallery';

    protected $fillable = [
        'type',
        'video',
        'foto',
        'gallery_album_id',
        'user_id',
    ];

    public function album()
    {
        return $this->belongsTo(GalleryAlbum::class, 'gallery_album_id');
    }

    public function getFoto()
    {
        return $this->foto ? Storage::url($this->foto) : asset('images/default.png');
    }

    public function getVideo()
    {
        return str_replace('watch?v=', 'embed/', $this->video);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getUrl()
    {
        return url('/').Storage::url($this->foto);
    }

}
