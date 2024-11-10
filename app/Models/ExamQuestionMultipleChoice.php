<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ExamQuestionMultipleChoice extends Model
{
    protected $table = 'exam_question_multiple_choice';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function question()
    {
        return $this->belongsTo(ExamQuestion::class, 'exam_question_id');
    }

    public function getImage()
    {
        return $this->image ? Storage::url($this->image) : null;
    }
}
