<?php

namespace App\Livewire\PpdbExam;

use App\Models\PpdbExamScheduleUser;
use App\Models\PpdbExamSession;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('exam.app')]
#[Title('Ujian')]
class Home extends Component
{
    public $exam_list;

    public function mount()
    {

        $this->exam_list = PpdbExamScheduleUser::leftJoin('ppdb_exam_schedule', 'ppdb_exam_schedule.id', '=', 'ppdb_exam_schedule_user.ppdb_exam_schedule_id')
            ->leftJoin('ppdb_exam', 'ppdb_exam.id', '=', 'ppdb_exam_schedule.ppdb_exam_id')
            ->leftJoin('ppdb_user', 'ppdb_user.id', '=', 'ppdb_exam_schedule_user.ppdb_user_id')
            ->leftJoin('ppdb_exam_session', 'ppdb_exam_session.ppdb_exam_id', '=', 'ppdb_exam.id')
            ->where('ppdb_user.id', Auth::guard('ppdb')->user()->id)
            ->select('ppdb_exam.name', 'ppdb_exam.duration', 'ppdb_exam_schedule.start_time', 'ppdb_exam_schedule.end_time','ppdb_exam_schedule.location', 'ppdb_exam_session.start_time as session_start_time', 'ppdb_exam_session.end_time as session_end_time', 'ppdb_exam_session.score as score')
            ->get();
    }

    public function startExam($id)
    {
        $session = PpdbExamSession::where('exam_id', $id)->where('student_id', Auth::user()->student->id)->first();
        if ($session) {
            return redirect()->route('exam.show',  $session->id);
        } else {
            $session = new PpdbExamSession();
            $session->ppdb_exam_id = $id;
            $session->ppdb_user_id = Auth::user()->id;
            $session->start_time = now();
            $session->save();
            return redirect()->route('exam.show', [$session->id]);
        }
    }

    public function render()
    {
        // dd($this->exam_list);
        return view('livewire.ppdb-exam.home');
    }
}
