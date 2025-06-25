<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditProfilPage extends Component
{
    public $name;
    public $email;

    public function mount()
    {
        $this->name  = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    public function update()
    {
        $this->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        Auth::user()->update([
            'name'  => $this->name,
            'email' => $this->email,
        ]);

        session()->flash('success', 'Profil berhasil diperbarui.');
        return redirect()->route('profil');
    }
    // === 3. Livewire akan merender view ini setiap kali state berubah ===
    public function render()
    {
        return view('livewire.edit-profil-page');
    }
}
