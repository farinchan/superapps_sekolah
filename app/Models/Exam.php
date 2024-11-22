<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'exam';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function examClassroom()
    {
        return $this->hasMany(ExamClassroom::class);
    }

    public function examQuestion()
    {
        return $this->hasMany(ExamQuestion::class);
    }

    public function examSession()
    {
        return $this->hasMany(ExamSession::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
