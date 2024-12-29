<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherAttendanceTimetable extends Model
{
    protected $table = 'teacher_attendance_timetable';

    protected $fillable = [
        'day',
        'start',
        'end',
    ];

    public function teachersTimetable()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_attendance_timetable_teacher');
    }

    public function attendance()
    {
        return $this->hasMany(TeacherAttendance::class);
    }

    public function getAttendance($teacherId)
    {
        return $this->attendance()->where('teacher_id', $teacherId)->where('date', date('Y-m-d'))->where('time', '>=', $this->start)->where('time', '<=', $this->end)->first();
    }
}
