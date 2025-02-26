<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbExamScheduleUser extends Model
{
    protected $table = 'ppdb_exam_schedule_user';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function schedule()
    {
        return $this->belongsTo(PpdbExamSchedule::class, 'ppdb_exam_schedule_id');
    }

    public function ppdbUser()
    {
        return $this->belongsTo(PpdbUser::class, 'ppdb_user_id');
    }

}
