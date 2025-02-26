<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbExamAnswer extends Model
{
    protected $table = 'ppdb_exam_answer';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $casts = [
        'answer' => 'array',
    ];

    public function ExamSession()
    {
        return $this->belongsTo(PpdbExamSession::class);
    }

    public function ExamQuestion()
    {
        return $this->belongsTo(PpdbExamQuestion::class);
    }
}
