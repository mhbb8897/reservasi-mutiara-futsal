<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Lapangan;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingPage extends Component
{
    public $lapangan;
    public $tanggal_booking;
    public $waktu_mulai;
    public $waktu_selesai;

    public function mount($lapangan)
    {
        $this->lapangan = Lapangan::findOrFail($lapangan);
    }

    protected function rules()
    {
        return [
            'tanggal_booking' => 'required|date|after_or_equal:today',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
        ];
    }

    public function simpan()
    {
        $this->validate();

        $existing = Booking::where('lapangan_id', $this->lapangan->id)
            ->where('tanggal_booking', $this->tanggal_booking)
            ->where(function ($query) {
                $query->whereBetween('waktu_mulai', [$this->waktu_mulai, $this->waktu_selesai])
                    ->orWhereBetween('waktu_selesai', [$this->waktu_mulai, $this->waktu_selesai])
                    ->orWhere(function ($query) {
                        $query->where('waktu_mulai', '<', $this->waktu_mulai)
                            ->where('waktu_selesai', '>', $this->waktu_selesai);
                    });
            })
            ->exists();

        if ($existing) {
            $this->addError('waktu_mulai', 'Waktu sudah dibooking oleh pengguna lain.');
            return;
        }

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'lapangan_id' => $this->lapangan->id,
            'tanggal_booking' => $this->tanggal_booking,
            'waktu_mulai' => $this->waktu_mulai,
            'waktu_selesai' => $this->waktu_selesai,
            'status' => 'pending',
        ]);

        // Redirect langsung ke halaman pembayaran
        return redirect()->route('pembayaran.page', $booking->id);
    }


    public function render()
    {
        return view('livewire.booking-page');
    }
}
