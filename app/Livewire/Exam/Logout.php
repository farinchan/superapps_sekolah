<?php

namespace App\Livewire\Exam;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Logout extends Component
{

    public function logout()
    {
        Auth::logout();
        return redirect()->route('exam.login');
    }
    public function render()
    {
        return view('livewire.exam.logout');
    }
}
