<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\BookingPage;
use App\Livewire\EditProfilPage;
use App\Livewire\HistoryPage;
use App\Livewire\HomePage;
use App\Livewire\JadwalPage;
use App\Livewire\LapanganPage;
use App\Livewire\PembayaranPage;
use App\Livewire\ProfilPage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class);
Route::get('/lapangan', LapanganPage::class)->name('lapangan.page');
Route::get('/jadwal/{lapanganId}', JadwalPage::class)->name('jadwal.page');

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class);
});

Route::middleware('auth')->group(function () {
Route::get('/booking/{lapangan}', BookingPage::class)->name('booking.page');
Route::get('/pembayaran', PembayaranPage::class)->name('pembayaran.page');
Route::get('/riwayat', HistoryPage::class)->name('riwayat.page');
Route::get('/profil', ProfilPage::class)->name('profil');
Route::get('/profil/edit', EditProfilPage::class)->name('edit-profil');
Route::get('/logout', function (){
        Auth::logout();
        return redirect('/');
    });
});
// Midtrans Payment Gateway
// Route::post('/midtrans/notification', [PaymentController::class, 'handleNotification']);
// Route::get('/midtrans/checkout/{token}', function ($token) {
//     return view('midtrans.checkout', compact('token'));
// })->name('midtrans.checkout');

