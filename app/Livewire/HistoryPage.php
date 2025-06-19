<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class HistoryPage extends Component
{
    use WithPagination;

    public function cancelOrder($id)
    {
        $booking = Booking::where('user_id', Auth::id())->where('id', $id)->firstOrFail();

        if ($booking->status == 'pending') {
            $booking->status = 'cancelled';
            $booking->save();
            session()->flash('success', 'Booking berhasil dibatalkan.');
        }
    }

    public function render()
    {
        $orders = Booking::with(['lapangan', 'pembayaran'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('livewire.history-page', compact('orders'));
    }
}
