<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
