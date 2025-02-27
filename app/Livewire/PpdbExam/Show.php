<?php

namespace App\Livewire\PpdbExam;

use App\Models\PpdbExam;
use App\Models\PpdbExamAnswer;
use App\Models\PpdbExamQuestion;
use App\Models\PpdbExamQuestionMultipleChoice;
use App\Models\PpdbExamSession;
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

    public $exam_multiple_choice_complex_id = [];
    public $exam_multiple_choice_complex_is_correct = [];

    public function mount($session_id)
    {
        $this->checkLogin();
        $this->exam_session_id = $session_id;
        $this->exam_session = PpdbExamSession::find($session_id);

        if ($this->exam_session) {
            if ($this->exam_session->ppdb_user_id == Auth::guard('ppdb')->user()->id) {

                $random_number = PpdbExamQuestion::where('ppdb_exam_id', $this->exam_session->ppdb_exam_id)
                    ->leftJoin('ppdb_exam_answer', function ($join) use ($session_id) {
                        $join->on('ppdb_exam_question.id', '=', 'ppdb_exam_answer.ppdb_exam_question_id')
                            ->where('ppdb_exam_answer.ppdb_exam_session_id', $session_id);
                    })
                    ->select('ppdb_exam_question.*', 'ppdb_exam_answer.answer')
                    ->inRandomOrder()
                    ->get()->pluck('id')->toArray();

                session(['random_question' =>  $random_number]);
                $this->exam = PpdbExam::find($this->exam_session->ppdb_exam_id);
                // dd($random_number);
                $this->exam_question = PpdbExamQuestion::where('ppdb_exam_id', $this->exam->id)->where('id', session('random_question')[0])->first();
                $this->exam_answer = PpdbExamAnswer::where('ppdb_exam_session_id', $this->exam_session->id)
                    ->where('ppdb_exam_question_id', $this->exam_question->id)
                    ->first();



                $this->refresh($session_id);
            } else {
                Alert::error('Error', 'Anda tidak memiliki akses ke ujian ini');
                return redirect()->route('exam.ppdb.home');
            }
        } else {
            Alert::error('Error', 'Anda tidak memiliki akses ke ujian ini');
            return redirect()->route('exam.ppdb.home');
        }
    }

    public function nextQuestion()
    {
        $this->checkLogin();
        $number = session('random_question');
        $next_number = array_search($this->exam_question->id, $number) + 1;
        $next_question = PpdbExamQuestion::where('ppdb_exam_id', $this->exam->id)
            ->where('id', $number[$next_number])
            ->first();

        if ($next_question) {
            $this->exam_question = $next_question;
            $this->exam_answer = PpdbExamAnswer::where('ppdb_exam_session_id', $this->exam_session->id)
                ->where('ppdb_exam_question_id', $this->exam_question->id)
                ->first();
            $this->refresh($this->exam_session_id); // Memastikan state diperbarui
        }
    }

    public function prevQuestion()
    {
        $this->checkLogin();
        $prev_question = PpdbExamQuestion::where('ppdb_exam_id', $this->exam->id)
            ->where('id', '<', $this->exam_question->id)
            ->first();

        if ($prev_question) {
            $this->exam_question = $prev_question;
            $this->exam_answer = PpdbExamAnswer::where('ppdb_exam_session_id', $this->exam_session->id)
                ->where('ppdb_exam_question_id', $this->exam_question->id)
                ->first();
            $this->refresh($this->exam_session_id); // Memastikan state diperbarui
        }
    }

    public function changeQuestion($id)
    {
        $this->checkLogin();
        $this->exam_question = PpdbExamQuestion::find($id);
        $this->exam_answer = PpdbExamAnswer::where('ppdb_exam_session_id', $this->exam_session->id)
            ->where('ppdb_exam_question_id', $this->exam_question->id)
            ->first();
        $this->refresh($this->exam_session_id); // Pastikan state diperbarui
    }

    public function answerMultipleChoice($id)
    {
        $answer = PpdbExamQuestionMultipleChoice::find($id);

        PpdbExamAnswer::updateOrCreate(
            [
                'ppdb_exam_session_id' => $this->exam_session->id,
                'ppdb_exam_question_id' => $this->exam_question->id,
            ],
            [
                'answer' => [
                    'multiple_choice' => [
                        'id' => $id,
                        'text' => $answer->choice_text
                    ]
                ],
                'is_correct' => $answer->is_correct,
                'score' => $answer->is_correct ? $this->exam_question->question_score : 0
            ]
        );

        $this->refresh($this->exam_session_id);
    }

    public function refresh($session_id)
    {
        $this->exam_session = PpdbExamSession::find($session_id);
        if ($this->exam_session->score) {
            Alert::info('Info', 'Ujian telah selesai');
            return redirect()->route('exam.ppdb.home');
        }
        // dd(session()->all());
        $this->exam_question_state = PpdbExamQuestion::whereIn('ppdb_exam_question.id', session('random_question'))
            ->leftJoin('ppdb_exam_answer', function ($join) use ($session_id) {
                $join->on('ppdb_exam_question.id', '=', 'ppdb_exam_answer.ppdb_exam_question_id')
                    ->where('ppdb_exam_answer.ppdb_exam_session_id', $session_id);
            })
            ->select('ppdb_exam_question.*', 'ppdb_exam_answer.answer')
            ->orderByRaw('FIELD(ppdb_exam_question.id, ' . implode(',', session('random_question')) . ')')
            ->get();

        $this->exam_question_percentage = PpdbExamAnswer::where('ppdb_exam_session_id', $session_id)
            ->count() / PpdbExamQuestion::where('ppdb_exam_id', $this->exam_session->ppdb_exam_id)->count() * 100;
    }

    public function endExam()
    {
        $total_score = PpdbExamAnswer::where('ppdb_exam_session_id', $this->exam_session_id)
            ->sum('score');

        PpdbExamSession::find($this->exam_session_id)->update([
            'end_time' => now(),
            'score' => $total_score
        ]);

        Alert::success('Berhasil', 'Ujian telah selesai');
        return redirect()->route('exam.ppdb.home');
    }

    public function checkLogin()
    {
        if (!Auth::guard("ppdb")->check()) {
            return redirect()->route('exam.login');
        }
    }


    public function render()
    {
        return view('livewire.ppdb-exam.show');
    }
}
