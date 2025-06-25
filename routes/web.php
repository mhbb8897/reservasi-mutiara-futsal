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
    // Lapangan
    Route::get('/booking/{lapangan}', BookingPage::class)->name('booking.page');
    // Payment
    Route::get('/pembayaran', PembayaranPage::class)->name('pembayaran.page');
    // History
    Route::get('/riwayat', HistoryPage::class)->name('riwayat.page');
    // Profile
    Route::get('/profil', ProfilPage::class)->name('profil');
    Route::get('/profil/edit', EditProfilPage::class)->name('profil.edit');
    Route::put('/profil/update', [EditProfilPage::class, 'update'])->name('profil.update');
    // Auth user
    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/');
    });
});
