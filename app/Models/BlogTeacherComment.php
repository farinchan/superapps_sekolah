<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogTeacherComment extends Model
{
    protected $table = 'blog_teacher_comment';

    protected $guarded = [];

    public function blogTeacher()
    {
        return $this->belongsTo(BlogTeacher::class);
    }
}
