<?php

namespace App\Livewire\Exam;

use App\Models\Exam;
use App\Models\ExamAnswer;
use App\Models\ExamQuestion;
use App\Models\ExamQuestionMultipleChoice;
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

    public function mount($session_id)
    {
        $this->exam_session_id = $session_id;
        $exam_session = ExamSession::find($session_id);
        if ($exam_session) {
            if ($exam_session->student_id == Auth::user()->student->id) {
                $this->exam_question = ExamQuestion::where('exam_id', $exam_session->exam_id)->first();
                $this->exam_answer = ExamAnswer::where('exam_session_id', $exam_session->id)->where('exam_question_id', $this->exam_question->id)->first();
                $this->exam = Exam::find($exam_session->exam_id);
                $this->refresh($session_id);
            } else {
                Alert::error('Error', 'Anda tidak memiliki akses ke ujian ini');
                redirect()->route('exam.home');
            }
        } else {
            Alert::error('Error', 'Anda tidak memiliki akses ke ujian ini');
            redirect()->route('exam.home');
        }
    }

    public function nextQuestion()
    {
        if ($this->exam_question->id < ExamQuestion::where('exam_id', $this->exam_question->exam_id)->max('id')) {
            $this->refresh($this->exam_session_id);
            $this->exam_question = ExamQuestion::where('exam_id', $this->exam_question->exam_id)->where('id', '>', $this->exam_question->id)->first();
            $this->exam_answer = ExamAnswer::where('exam_session_id', $this->exam_session->id)->where('exam_question_id', $this->exam_question->id)->first();
        }
    }

    public function prevQuestion()
    {
        if ($this->exam_question->id > ExamQuestion::where('exam_id', $this->exam_question->exam_id)->min('id')) {
            $this->refresh($this->exam_session_id);
            $this->exam_question = ExamQuestion::where('exam_id', $this->exam_question->exam_id)->where('id', '<', $this->exam_question->id)->first();
            $this->exam_answer = ExamAnswer::where('exam_session_id', $this->exam_session->id)->where('exam_question_id', $this->exam_question->id)->first();
        }
    }

    public function changeQuestion($id)
    {
        $this->refresh($this->exam_session_id);
        $this->exam_question = ExamQuestion::find($id);
        $this->exam_answer = ExamAnswer::where('exam_session_id', $this->exam_session->id)->where('exam_question_id', $this->exam_question->id)->first();
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
                        'text' => $answer->text
                    ]
                ],
                'is_correct' => $answer->is_correct
            ]
        );
        $this->refresh($this->exam_session_id);
    }

    public function refresh($session_id)
    {
        $exam_session = ExamSession::find($session_id);
        $this->exam_session = $exam_session;
        $this->exam_question_state = ExamQuestion::where('exam_id', $exam_session->exam_id)->leftJoin('exam_answer', function ($join) use ($exam_session) {
            $join->on('exam_question.id', '=', 'exam_answer.exam_question_id')
                ->where('exam_answer.exam_session_id', $exam_session->id);
        })->select('exam_question.*', 'exam_answer.answer')->get();
        $this->exam_question_percentage = ExamAnswer::where('exam_session_id', $exam_session->id)->get()->count()   / ExamQuestion::where('exam_id', $exam_session->exam_id)->get()->count() * 100;
    }

    public function endExam() {
        $total_score = ExamAnswer::where('exam_session_id', $this->exam_session_id)->where('is_correct', true)->get()->count();
        ExamSession::find($this->exam_session_id)->update([
            'end_time' => now(),
            'score' => $total_score / ExamQuestion::where('exam_id', $this->exam_session->exam_id)->get()->count() * 100
        ]);
        Alert::success('Berhasil', 'Ujian telah selesai');
        redirect()->route('exam.home');
    }

    public function render()
    {
        // dd($this->exam_question_state);
        return view('livewire.exam.show');
    }
}
