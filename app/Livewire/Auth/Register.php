<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
    {
        public $name,$email,$password, $captcha;

        public function save()
    {
        $this->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6|max:255',
            'captcha' => 'required|captcha',
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        session()->flash('success', 'Akun berhasil dibuat. Silakan login.');

        return redirect()->intended('/login');
    }


    public function render()
    {
        return view('livewire.auth.register');
    }
}
