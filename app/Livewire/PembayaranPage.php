<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Pembayaran;

class PembayaranPage extends Component
{
    public $booking, $nominal;

    public function mount($booking)
    {
        $this->booking = Booking::with('lapangan')->findOrFail($booking);

        // Ambil langsung nominal dari kolom booking
        $this->nominal = $this->booking->nominal;
    }

    public function simpan()
    {
        Pembayaran::create([
            'booking_id' => $this->booking->id,
            'total' => $this->nominal,
            'status' => 'waiting', // atau 'pending'
            'paid_at' => now(),
        ]);

        session()->flash('success', 'Data pembayaran berhasil dikirim.');
        return redirect()->route('riwayat.page', $this->booking->lapangan_id);
    }

    public function render()
    {
        return view('livewire.pembayaran-page', [
            'total' => $this->nominal,
        ]);
    }
}
