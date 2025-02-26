<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbExamSchedule extends Model
{
    protected $table = 'ppdb_exam_schedule';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function exam()
    {
        return $this->belongsTo(PpdbExam::class, 'ppdb_exam_id');
    }

    public function scheduleUser()
    {
        return $this->hasMany(PpdbExamScheduleUser::class, 'ppdb_exam_schedule_id');
    }
}
