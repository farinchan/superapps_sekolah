<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class BlogTeacher extends Model
{

    protected $table = 'blog_teacher';

    protected $guarded = [];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function comments()
    {
        return $this->hasMany(BlogTeacherComment::class);
    }

    public function viewers()
    {
        return $this->hasMany(BlogTeacherViewer::class);
    }

    public function getThumbnail()
    {
        return $this->thumbnail ? Storage::url($this->thumbnail) : asset('img_ext/no-image.png');
    }
}
