<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbExam extends Model
{
    protected $table = 'ppdb_exam';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function examQuestion()
    {
        return $this->hasMany(PpdbExamQuestion::class);
    }

    public function examSession()
    {
        return $this->hasMany(PpdbExamSession::class);
    }

    public function examSchedule()
    {
        return $this->hasMany(PpdbExamSchedule::class);
    }

    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class);
    }
}
