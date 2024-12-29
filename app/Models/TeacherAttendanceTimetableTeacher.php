<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherAttendanceTimetableTeacher extends Model
{
    protected $table = 'teacher_attendance_timetable_teacher';

    protected $fillable = [
        'teacher_id',
        'teacher_attendance_timetable_id',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function timetable()
    {
        return $this->belongsToMany(TeacherAttendanceTimetable::class, 'teacher_attendance_timetable_teacher');
    }
}
