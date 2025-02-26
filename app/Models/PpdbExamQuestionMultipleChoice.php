<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PpdbExamQuestionMultipleChoice extends Model
{
    protected $table = 'ppdb_exam_question_multiple_choice';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function question()
    {
        return $this->belongsTo(PpdbExamQuestion::class, 'exam_question_id');
    }

    public function getImage()
    {
        return $this->choice_image ? Storage::url($this->choice_image) : null;
    }
}
