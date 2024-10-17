<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogTeacherViewer extends Model
{
    protected $table = 'blog_teacher_viewer';

    protected $guarded = [];

    public function blogTeacher()
    {
        return $this->belongsTo(BlogTeacher::class);
    }
}
