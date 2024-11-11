<?php

namespace App\Livewire\Exam;

use App\Models\Exam;
use App\Models\ExamAnswer;
use App\Models\ExamQuestion;
use App\Models\ExamQuestionMultipleChoice;
use App\Models\ExamQuestionMultipleChoiceComplex;
use App\Models\ExamSession;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

#[Layout('exam.app')]
class Show extends Component
{
    public $exam_session_id;
    public $exam_session;
    public $exam;
    public $exam_question;
    public $exam_answer;
    public $exam_question_state;
    public $exam_question_percentage;

    public $exam_multiple_choice_complex_text = [];
    public $exam_multiple_choice_complex_is_correct = [];

    public function mount($session_id)
    {
        $this->exam_session_id = $session_id;
        $this->exam_session = ExamSession::find($session_id);

        if ($this->exam_session) {
            if ($this->exam_session->student_id == Auth::user()->student->id) {
                $this->exam = Exam::find($this->exam_session->exam_id);
                $this->exam_question = ExamQuestion::where('exam_id', $this->exam->id)->first();
                $this->exam_answer = ExamAnswer::where('exam_session_id', $this->exam_session->id)
                    ->where('exam_question_id', $this->exam_question->id)
                    ->first();
                $this->refresh($session_id);
            } else {
                Alert::error('Error', 'Anda tidak memiliki akses ke ujian ini');
                return redirect()->route('exam.home');
            }
        } else {
            Alert::error('Error', 'Anda tidak memiliki akses ke ujian ini');
            return redirect()->route('exam.home');
        }
    }

    public function nextQuestion()
    {
        $next_question = ExamQuestion::where('exam_id', $this->exam->id)
            ->where('id', '>', $this->exam_question->id)
            ->first();

        if ($next_question) {
            $this->exam_question = $next_question;
            $this->exam_answer = ExamAnswer::where('exam_session_id', $this->exam_session->id)
                ->where('exam_question_id', $this->exam_question->id)
                ->first();
            $this->refresh($this->exam_session_id); // Memastikan state diperbarui
        }
    }

    public function prevQuestion()
    {
        $prev_question = ExamQuestion::where('exam_id', $this->exam->id)
            ->where('id', '<', $this->exam_question->id)
            ->first();

        if ($prev_question) {
            $this->exam_question = $prev_question;
            $this->exam_answer = ExamAnswer::where('exam_session_id', $this->exam_session->id)
                ->where('exam_question_id', $this->exam_question->id)
                ->first();
            $this->refresh($this->exam_session_id); // Memastikan state diperbarui
        }
    }

    public function changeQuestion($id)
    {
        $this->exam_question = ExamQuestion::find($id);
        $this->exam_answer = ExamAnswer::where('exam_session_id', $this->exam_session->id)
            ->where('exam_question_id', $this->exam_question->id)
            ->first();
        $this->refresh($this->exam_session_id); // Pastikan state diperbarui
    }

    public function answerMultipleChoice($id)
    {
        $answer = ExamQuestionMultipleChoice::find($id);

        ExamAnswer::updateOrCreate(
            [
                'exam_session_id' => $this->exam_session->id,
                'exam_question_id' => $this->exam_question->id,
            ],
            [
                'answer' => [
                    'multiple_choice' => [
                        'id' => $id,
                        'text' => $answer->choice_text
                    ]
                ],
                'is_correct' => $answer->is_correct
            ]
        );

        $this->refresh($this->exam_session_id);
    }

    public function answerMultipleChoiceComplex($id)
    {
        $answer = ExamQuestionMultipleChoiceComplex::find($id);

        // Cek apakah pilihan sudah ada dalam array
        if (in_array($id, $this->exam_multiple_choice_complex_text)) {
            // Jika sudah ada, hapus dari array
            $key = array_search($id, $this->exam_multiple_choice_complex_text);
            array_splice($this->exam_multiple_choice_complex_text, $key, 1);
            array_splice($this->exam_multiple_choice_complex_is_correct, $key, 1);
        } else {
            // Jika belum ada, tambahkan ke array
            $this->exam_multiple_choice_complex_text[] = $id;
            $this->exam_multiple_choice_complex_is_correct[] = $answer->is_correct;
        }

        // Simpan atau perbarui jawaban di database
        ExamAnswer::updateOrCreate(
            [
                'exam_session_id' => $this->exam_session->id,
                'exam_question_id' => $this->exam_question->id,
            ],
            [
                'answer' => [
                    'multiple_choice_complex' => array_map(function ($id) {
                        return [
                            'id' => $id,
                            'text' => ExamQuestionMultipleChoiceComplex::find($id)->choice_text
                        ];
                    }, $this->exam_multiple_choice_complex_text)
                ],
                'is_correct' => collect($this->exam_multiple_choice_complex_is_correct)->contains(false) ? false : true
            ]
        );

        // Perbarui state soal ujian
        $this->refresh($this->exam_session_id);
    }

    public function refresh($session_id)
    {
        $this->exam_session = ExamSession::find($session_id);
        $this->exam_question_state = ExamQuestion::where('exam_id', $this->exam_session->exam_id)
            ->leftJoin('exam_answer', function ($join) use ($session_id) {
                $join->on('exam_question.id', '=', 'exam_answer.exam_question_id')
                    ->where('exam_answer.exam_session_id', $session_id);
            })
            ->select('exam_question.*', 'exam_answer.answer')
            ->get();

        $this->exam_question_percentage = ExamAnswer::where('exam_session_id', $session_id)
            ->count() / ExamQuestion::where('exam_id', $this->exam_session->exam_id)->count() * 100;
    }

    public function endExam()
    {
        $total_score = ExamAnswer::where('exam_session_id', $this->exam_session_id)
            ->where('is_correct', true)
            ->count();

        ExamSession::find($this->exam_session_id)->update([
            'end_time' => now(),
            'score' => $total_score / ExamQuestion::where('exam_id', $this->exam_session->exam_id)->count() * 100
        ]);

        Alert::success('Berhasil', 'Ujian telah selesai');
        return redirect()->route('exam.home');
    }

    public function render()
    {
        return view('livewire.exam.show');
    }
}
