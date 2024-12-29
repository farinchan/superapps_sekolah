<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherAttendance extends Model
{
    protected $table = 'teacher_attendance';

    protected $fillable = [
        'teacher_id',
        'date',
        'time',
        'latitude',
        'longitude',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function timetableTeacher()
    {
        return $this->belongsToMany(TeacherAttendanceTimetable::class, 'teacher_attendance_timetable_teacher');
    }


}
