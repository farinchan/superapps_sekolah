<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamQuestionMultipleChoiceComplex extends Model
{
    protected $table = 'exam_question_multiple_choice_complex';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function question()
    {
        return $this->belongsTo(ExamQuestion::class, 'exam_question_id');
    }
}
