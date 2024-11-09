<?php

namespace App\Imports;

use App\Models\ExamQuestion;
use Illuminate\Support\Collection;
use App\Models\ExamQuestionMultipleChoice;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class ImportExamMultipleChoice implements ToModel, WithHeadingRow, WithValidation, WithCustomStartCell
{
    /**
     * @param Collection $collection
     */

     public function __construct()
    {
        HeadingRowFormatter::default('none');
    }

    public function model(array $row)
    {

        $question_id = 0;

        if ($row["kode"] == "Q") {
            $question = new ExamQuestion();
            $question->question_type = "pilihan ganda";
            $question->question_text = $row["isi"];
            $question->save();
            $question_id = $question->id;
        } elseif ($row["kode"] == "A") {
            $question = new ExamQuestionMultipleChoice();
            $question->question_id = $question_id;
            $question->choice_text = $row["isi"];
            $question->is_correct = $row["jawaban_benar"];
            $question->save();
        }
    }

    public function rules(): array
    {
        return [
            'kode' => 'required',
            'isi' => 'required',
            'jawaban_benar' => 'nullable',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'kode.required' => 'Kode soal harus diisi',
            'isi.required' => 'Isi soal harus diisi',
        ];
    }

    public function startCell(): string
    {
        return 'A6';  // Mulai di baris 1
    }
}
