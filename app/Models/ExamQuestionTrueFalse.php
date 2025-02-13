<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ExamQuestionTrueFalse extends Model
{
    protected $table = 'exam_question_true_false';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function exam_question()
    {
        return $this->belongsTo(ExamQuestion::class);
    }

    public function getImage()
    {
        return $this->choice_image ? Storage::url($this->choice_image) : null;
    }
}
