<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Title as AttributesTitle;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email, $password, $captcha;

    public function save()
    {
        $this->validate([
            'email' => 'required|email|max:255|exists:users,email',
            'password' => 'required|min:6|max:255',
            'captcha' => 'required|captcha',
        ]);

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->flash('error', 'Invalid credentials');
            return;
        }

        return redirect()->intended();
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
