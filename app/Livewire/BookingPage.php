<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Lapangan;
use App\Models\Booking;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class BookingPage extends Component
{
    public $lapangan;
    public $tanggal_booking;
    public $jam_main;
    public $waktu_mulai;
    public $waktu_selesai;
    public $jenis_pembayaran;
    public $nominal;

    public function mount($lapangan)
    {
        $this->lapangan = Lapangan::findOrFail($lapangan);
    }

    protected function rules()
    {
        return [
            'tanggal_booking' => 'required|date|after_or_equal:today',
            'jam_main' => 'required|date_format:H:i',
            'jenis_pembayaran' => 'required|in:dp,setengah,penuh',
        ];
    }

    public function simpan()
    {
        $this->validate();

        $waktu_mulai = Carbon::createFromFormat('H:i', $this->jam_main);
        $waktu_selesai = $waktu_mulai->copy()->addHour();

        $existing = Booking::where('lapangan_id', $this->lapangan->id)
            ->where('tanggal_booking', $this->tanggal_booking)
            ->where(function ($query) use ($waktu_mulai, $waktu_selesai) {
                $query->whereBetween('waktu_mulai', [$waktu_mulai->format('H:i:s'), $waktu_selesai->format('H:i:s')])
                    ->orWhereBetween('waktu_selesai', [$waktu_mulai->format('H:i:s'), $waktu_selesai->format('H:i:s')])
                    ->orWhere(function ($query) use ($waktu_mulai, $waktu_selesai) {
                        $query->where('waktu_mulai', '<', $waktu_mulai->format('H:i:s'))
                            ->where('waktu_selesai', '>', $waktu_selesai->format('H:i:s'));
                    });
            })
            ->exists();

        if ($existing) {
            $this->addError('jam_main', 'Waktu ini sudah dibooking oleh pengguna lain.');
            return;
        }

        $nominal = match ($this->jenis_pembayaran) {
            'dp' => 10000,
            'setengah' => 75000,
            'penuh' => 150000,
        };

        session([
            'booking_data' => [
                'user_id' => Auth::id(),
                'lapangan_id' => $this->lapangan->id,
                'tanggal_booking' => $this->tanggal_booking,
                'waktu_mulai' => $waktu_mulai->format('H:i:s'),
                'waktu_selesai' => $waktu_selesai->format('H:i:s'),
                'jenis_pembayaran' => $this->jenis_pembayaran,
                'nominal' => $nominal,
            ]
        ]);

        return redirect()->route('pembayaran.page');
    }

    public function render()
    {
        $lapangan = Lapangan::all();

        return view('livewire.booking-page', compact('lapangan'));
    }
}
