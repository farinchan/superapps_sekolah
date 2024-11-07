<?php

namespace App\Livewire\Exam;

use App\Models\ExamClassroom;
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
        $this->exam_list = ExamClassroom::with(['exam', 'classroom'])->whereHas('classroom', function ($query) {
            $query->whereHas('classroomStudent', function ($query) {
                $query->where('student_id', Auth::user()->student->id);
            });
        })->join('exam', 'exam.id', '=', 'exam_classroom.exam_id')
            ->leftJoin('teacher', 'teacher.id', '=', 'exam.teacher_id')
            ->leftJoin('exam_session', 'exam_session.exam_id', '=', 'exam.id')
            ->select('exam.*', 'teacher.name as teacher_name', 'teacher.nip  as teacher_nip', 'exam_session.start_time as session_start_time', 'exam_session.end_time as session_end_time', 'exam_session.score as score')
            ->get();
    }
    public function render()
    {
        // dd($this->exam_list);
        return view('livewire.exam.home');
    }
}
