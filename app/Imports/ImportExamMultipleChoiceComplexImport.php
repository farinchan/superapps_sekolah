<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\ExamQuestion;
use App\Models\ExamQuestionMultipleChoiceComplex;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithStartRow;


class ImportExamMultipleChoiceComplexImport implements ToModel, WithHeadingRow, WithValidation, WithStartRow
{
   /**
     * @param Collection $collection
     */

     private $exam_id;
     private $question_id = 0;

     public function __construct($exam_id)
    {
        HeadingRowFormatter::default('none');
        $this->exam_id = $exam_id;
    }

    public function model(array $row)
    {


        if ($row[1] == "Q") {
            $question = new ExamQuestion();
            $question->exam_id = $this->exam_id;
            $question->question_type = "pilihan ganda kompleks";
            $question->question_text = $row[2];
            $question->question_score = $row[4];
            $question->save();
            $this->question_id = $question->id;
        } elseif ($row[1] == "A") {
            $multipleChoiceComplex = new ExamQuestionMultipleChoiceComplex();
            $multipleChoiceComplex->exam_question_id = $this->question_id;
            $multipleChoiceComplex->choice_text = $row[2];
            $multipleChoiceComplex->is_correct = $row[3];
            $multipleChoiceComplex->save();
        }
    }

    public function rules(): array
    {
        return [
            '1' => 'required',
            '2' => 'required',
            '3' => 'nullable',
        ];
    }

    public function customValidationMessages()
    {
        return [
            '1.required' => 'Kode soal/Jawaban harus diisi',
            '2.required' => 'Isi soal/Jawaban harus diisi',
        ];
    }

    public function startRow(): int
    {
        return 7;  // Mulai di baris 7
    }
}
