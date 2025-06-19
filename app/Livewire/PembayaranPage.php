<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Booking;
use App\Models\Pembayaran;

class PembayaranPage extends Component
{
    use WithFileUploads;

    public $booking;
    public $metode_pembayaran;
    public $bukti_pembayaran;
    public $total;

    public function mount($booking)
    {
        $this->booking = Booking::with('lapangan')->findOrFail($booking);
        $this->total = $this->hitungTotal();
    }

    public function hitungTotal()
    {
        $mulai = strtotime($this->booking->waktu_mulai);
        $selesai = strtotime($this->booking->waktu_selesai);
        $jam = ($selesai - $mulai) / 3600;
        return $jam * $this->booking->lapangan->harga_per_jam;
    }

    protected function rules()
    {
        return [
            'metode_pembayaran' => 'required|in:qris,transfer,cash',
            'bukti_pembayaran' => 'nullable|image|max:2048', // max 2MB
        ];
    }

    public function simpan()
    {
        $this->validate();

        $buktiPath = $this->bukti_pembayaran
            ? $this->bukti_pembayaran->store('bukti-pembayaran', 'public')
            : null;

        Pembayaran::create([
            'booking_id' => $this->booking->id,
            'metode_pembayaran' => $this->metode_pembayaran,
            'total' => $this->total,
            'bukti_pembayaran' => $buktiPath,
            'status' => 'waiting',
            'paid_at' => now(),
        ]);

        session()->flash('success', 'Pembayaran berhasil dikirim!');
        return redirect()->route('riwayat.page', $this->booking->lapangan_id);
    }

    public function render()
    {
        return view('livewire.pembayaran-page');
    }
}
