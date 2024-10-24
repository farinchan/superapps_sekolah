<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class TeacherAchievement extends Model
{
    protected $table = 'teacher_achievement';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }

    public function getImage(){
        return $this->image ? Storage::url($this->image) : asset('img_ext/no-image.png');
    }

    public function getFile(){
        return Storage::url($this->file);
    }
}
