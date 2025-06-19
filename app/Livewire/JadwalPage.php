<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Lapangan;
use App\Models\Booking;
use Carbon\Carbon;

class JadwalPage extends Component
{
    public $lapangan;
    public $tanggal;
    public $bookings = [];

    public function mount($lapanganId)
    {
        $this->lapangan = Lapangan::findOrFail($lapanganId);
        $this->tanggal = now()->toDateString();
        $this->loadBookings();
    }

    public function updatedTanggal()
    {
        //
    }

    public function loadBookings()
    {
        $this->bookings = Booking::where('lapangan_id', $this->lapangan->id)
            ->where('tanggal_booking', $this->tanggal)
            ->orderBy('waktu_mulai')
            ->get();
    }

    public function render()
    {
        return view('livewire.jadwal-page');
    }
}
