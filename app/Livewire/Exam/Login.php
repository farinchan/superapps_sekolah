<?php

namespace App\Livewire\Exam;

use App\Models\LogLoginElearning;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Jenssegers\Agent\Facades\Agent;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;

#[Layout('exam.app-auth')]
class Login extends Component
{
    //Form fields
    public $identifier;
    public $password;

    protected $rules = [
        'identifier' => 'required',
        'password' => 'required',
    ];

    protected $messages = [
        'identifier.required' => 'NISN harus diisi',
        'password.required' => 'Password harus diisi',
    ];

    public function render()
    {
        return view('livewire.exam.login');
    }

    public function login()
    {
        $this->validate();

        $user = null;
        // Cek apakah ini login Siswa
        $student = Student::where('nisn', $this->identifier)->first();
        if ($student) {
            $user = $student->user;
        }

        if ($user && Hash::check($this->password, $user->password)) {
            Auth::login($user);
            LogLoginElearning::create([
                'user_id' => $user->id,
                'ip' => request()->ip(),
                'user_agent' => Agent::getUserAgent(),
                'platform' => Agent::platform(),
                'browser' => Agent::browser(),
                'device' => Agent::device(),
            ]);
            session()->flash('success', 'Login berhasil');
            return redirect()->route('exam.home');
        } else {
            session()->flash('error', 'NISN atau password salah');
        }
    }

}
