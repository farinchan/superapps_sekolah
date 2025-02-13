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
use phpDocumentor\Reflection\Types\This;
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
        $this->exam_session = ExamSession::find($session_id);

        if ($this->exam_session) {
            if ($this->exam_session->student_id == Auth::user()->student->id) {

                $random_number = ExamQuestion::where('exam_id', $this->exam_session->exam_id)
                    ->leftJoin('exam_answer', function ($join) use ($session_id) {
                        $join->on('exam_question.id', '=', 'exam_answer.exam_question_id')
                            ->where('exam_answer.exam_session_id', $session_id);
                    })
                    ->select('exam_question.*', 'exam_answer.answer')
                    ->inRandomOrder()
                    ->get()->pluck('id')->toArray();

                session(['random_question' =>  $random_number]);

                $this->exam = Exam::find($this->exam_session->exam_id);
                $this->exam_question = ExamQuestion::where('exam_id', $this->exam->id)->where('id', session('random_question')[0])->first();
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
        $this->checkLogin();
        $number = session('random_question');
        $next_number = array_search($this->exam_question->id, $number) + 1;
        $next_question = ExamQuestion::where('exam_id', $this->exam->id)
            ->where('id', $number[$next_number])
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
        $this->checkLogin();
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
        $this->checkLogin();
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
        $anwer_correct_id = ExamQuestionMultipleChoiceComplex::where('exam_question_id', $this->exam_question->id)
            ->where('is_correct', true)
            ->pluck('id')->toArray();

        $exam_answer_multiple_choice_complex = ExamAnswer::where('exam_session_id', $this->exam_session->id)
            ->where('exam_question_id', $this->exam_question->id)
            ->first();

            // Ambil id jawaban yang sudah ada


            $new_answer = array_column($exam_answer_multiple_choice_complex->answer['multiple_choice_complex'] ?? [], 'id');
            $correct = null;

            // dd($new_answer, $exam_answer_multiple_choice_complex_id, $anwer_correct_id);

            // Cek apakah pilihan sudah ada dalam array
            if (in_array($id,  $new_answer)) {
                // Jika sudah ada, hapus dari array
                $new_answer = array_diff($new_answer, [$id]);
            } else {
                // Jika belum ada, tambahkan ke array
                $new_answer[] = $id;
            }

            if (empty(array_diff($anwer_correct_id, $new_answer)) && empty(array_diff($new_answer, $anwer_correct_id))) {
                $correct = true;
            } else {
                $correct = false;
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
                    }, $new_answer)
                ],
                'is_correct' => $correct
            ]
        );

        // Perbarui state soal ujian
        $this->refresh($this->exam_session_id);
    }

    public function refresh($session_id)
    {
        $this->exam_session = ExamSession::find($session_id);
        if ($this->exam_session->score) {
            Alert::info('Info', 'Ujian telah selesai');
            return redirect()->route('exam.home');
        }
        // dd(session()->all());
        $this->exam_question_state = ExamQuestion::whereIn('exam_question.id', session('random_question'))
            ->leftJoin('exam_answer', function ($join) use ($session_id) {
                $join->on('exam_question.id', '=', 'exam_answer.exam_question_id')
                    ->where('exam_answer.exam_session_id', $session_id);
            })
            ->select('exam_question.*', 'exam_answer.answer')
            ->orderByRaw('FIELD(exam_question.id, ' . implode(',', session('random_question')) . ')')
            ->get();

        $this->exam_question_percentage = ExamAnswer::where('exam_session_id', $session_id)
            ->count() / ExamQuestion::where('exam_id', $this->exam_session->exam_id)->count() * 100;
    }

    public function endExam()
    {
        $total_score = ExamAnswer::where('exam_session_id', $this->exam_session_id)
            ->where('is_correct', true)
            ->join('exam_question', 'exam_question.id', '=', 'exam_answer.exam_question_id')
            ->sum('exam_question.question_score');

        ExamSession::find($this->exam_session_id)->update([
            'end_time' => now(),
            'score' => $total_score
        ]);

        Alert::success('Berhasil', 'Ujian telah selesai');
        return redirect()->route('exam.home');
    }

    public function checkLogin()
    {
        if (!Auth::check()) {
            return redirect()->route('exam.login');
        }
    }

    public function render()
    {
        return view('livewire.exam.show');
    }
}
