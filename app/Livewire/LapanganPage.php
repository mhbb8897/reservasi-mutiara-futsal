<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Lapangan;

class LapanganPage extends Component
{
    public $sort = 'latest';

    public function render()
    {
        $lapangans = Lapangan::query();

        if ($this->sort === 'price') {
            $lapangans->orderBy('harga_per_jam');
        } else {
            $lapangans->latest();
        }

        return view('livewire.lapangan-page', [
            'lapangans' => $lapangans->get()
        ]);
    }

    public function bookNow($id)
    {
        session()->flash('success', 'Lapangan berhasil dipilih.');
        return redirect()->to('/booking/' . $id);
    }
}
