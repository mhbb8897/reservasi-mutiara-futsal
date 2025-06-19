<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\Pembayaran;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget\Card;

class BookingStats extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Booking', Booking::count()),

            Card::make('Total Pendapatan', 'Rp ' . number_format(
                Pembayaran::where('status', 'paid')->sum('total'),
                0, ',', '.'
            )),

            Card::make('Pendapatan Hari Ini', 'Rp ' . number_format(
                Pembayaran::whereDate('paid_at', Carbon::today())->where('status', 'paid')->sum('total'),
                0, ',', '.'
            )),

            Card::make('Booking Pending', Booking::where('status', 'pending')->count()),

            Card::make('Booking Disetujui', Booking::where('status', 'confirmed')->count()),
        ];
    }

    protected static ?string $pollingInterval = '10s';
}
