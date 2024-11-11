<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $table = 'classroom';
    protected $fillable = ['name', 'teacher_id', 'school_year_id'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class, 'school_year_id');
    }

    public function classroomStudent()
    {
        return $this->hasMany(ClassroomStudent::class, 'classroom_id');
    }

    public function examClassroom()
    {
        return $this->hasMany(ExamClassroom::class, 'classroom_id');
    }
}
