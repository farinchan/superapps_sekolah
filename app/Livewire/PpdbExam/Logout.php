<?php

namespace App\Livewire\PpdbExam;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Logout extends Component
{
    public function logout()
    {
        Auth::guard('ppdb')->logout();
        return redirect()->route('exam.login');
    }
    public function render()
    {
        return view('livewire.ppdb-exam.logout');
    }
}
