<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'exam';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function ExamClassroom()
    {
        return $this->belongsTo(ExamClassroom::class);
    }

    public function ExamQuestion()
    {
        return $this->hasMany(ExamQuestion::class);
    }

    public function ExamAnswer()
    {
        return $this->hasMany(ExamAnswer::class);
    }
}
