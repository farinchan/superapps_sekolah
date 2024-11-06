<?php

namespace App\Livewire\Exam;

use App\Models\ExamClassroom;
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
        $this->exam_list = ExamClassroom::with(['exam', 'classroom'])->get();
    }
    public function render()
    {
        return view('livewire.exam.home');
    }
}
