<?php

namespace App\Livewire\Exam;

use App\Models\ExamClassroom;
use App\Models\ExamSession;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('exam.app')]
#[Title('Ujian')]
class Home extends Component
{
    public $exam_list;

    public function mount()
    {
        // $this->exam_list = ExamClassroom::with(['exam', 'classroom'])->whereHas('classroom', function ($query) {
        //     $query->whereHas('classroomStudent', function ($query) {
        //         $query->where('student_id', Auth::user()->student->id);
        //     });
        // })->join('exam', 'exam.id', '=', 'exam_classroom.exam_id')
        //     ->join('subject', 'subject.id', '=', 'exam.subject_id')
        //     ->leftJoin('teacher', 'teacher.id', '=', 'exam.teacher_id')
        //     ->leftJoin('exam_session', 'exam_session.exam_id', '=', 'exam.id')
        //     ->select('exam.*', 'subject.name as subject', 'teacher.name as teacher_name', 'teacher.nip  as teacher_nip', 'exam_session.start_time as session_start_time', 'exam_session.end_time as session_end_time', 'exam_session.score as score')
        //     ->orderBy('exam_session.start_time', 'desc')
        //     ->get();

        $this->exam_list = ExamClassroom::with(['exam', 'classroom'])
            ->whereHas('classroom', function ($query) {
                $query->whereHas('classroomStudent', function ($query) {
                    $query->where('student_id', Auth::user()->student->id);
                });
            })->join('exam', 'exam.id', '=', 'exam_classroom.exam_id')
            ->where('exam.start_time', '<=', now())
            ->join('subject', 'subject.id', '=', 'exam.subject_id')
            ->leftJoin('teacher', 'teacher.id', '=', 'exam.teacher_id')
            ->leftJoin('exam_session', function ($join) {
                $join->on('exam_session.exam_id', '=', 'exam.id')
                    ->where('exam_session.student_id', '=', Auth::user()->student->id);
            })
            ->select('exam.*', 'subject.name as subject', 'teacher.name as teacher_name', 'teacher.nip  as teacher_nip', 'exam_session.start_time as session_start_time', 'exam_session.end_time as session_end_time', 'exam_session.score as score')
            ->orderBy('exam_session.start_time', 'desc')
            ->get();
    }

    public function startExam($id)
    {
        $session = ExamSession::where('exam_id', $id)->where('student_id', Auth::user()->student->id)->first();
        if ($session) {
            return redirect()->route('exam.show',  $session->id);
        } else {
            $session = new ExamSession();
            $session->exam_id = $id;
            $session->student_id = Auth::user()->student->id;
            $session->start_time = now();
            $session->save();
            return redirect()->route('exam.show', [$session->id]);
        }
    }
    public function render()
    {
        // dd($this->exam_list);
        return view('livewire.exam.home');
    }
}
