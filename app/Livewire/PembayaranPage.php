<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class PembayaranPage extends Component
{
    public $booking, $nominal, $snapToken;

    public function mount()
    {
        $data = session('booking_data');

        if (!$data) {
            return redirect()->route('riwayat.page');
        }
        $this->booking = new Booking($data);
        $this->nominal = $this->booking->nominal;

        // ✅ Setup Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Payload ke Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . uniqid(),
                'gross_amount' => $this->nominal,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'phone' => Auth::user()->phone,
                'email' => Auth::user()->email,
            ],
        ];
        // dd($params);

        // ✅ Ambil SnapToken
        $this->snapToken = Snap::getSnapToken($params);
    }

    // Tambahkan event listener di Livewire
    protected $listeners = ['paymentSuccess' => 'simpan'];

    public function simpan()
    {
        $data = session('booking_data');
        if (!$data) return;

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'lapangan_id' => $data['lapangan_id'],
            'tanggal_booking' => $data['tanggal_booking'],
            'waktu_mulai' => $data['waktu_mulai'],
            'waktu_selesai' => $data['waktu_selesai'],
            'ket_pembayaran' => $data['ket_pembayaran'],
            'nominal' => $data['nominal'],
        ]);

        Pembayaran::create([
            'booking_id' => $booking->id,
            'total' => $booking->nominal,
            'status' => 'waiting',
            'metode_pembayaran' => 'qris',
            'paid_at' => now(),
        ]);

        session()->forget('booking_data');
        session()->flash('success', 'Pembayaran berhasil dan data disimpan.');

        // Redirect ke riwayat berdasarkan lapangan
        return redirect()->route('riwayat.page', ['lapangan' => $booking->lapangan_id]);
    }

    public function render()
    {
        return view('livewire.pembayaran-page');
    }
}
