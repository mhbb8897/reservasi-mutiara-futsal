<?php

namespace App\Filament\Resources\BookingResource\Pages;

use App\Filament\Resources\BookingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Support\Htmlable;

class ListBookings extends ListRecords
{
    protected static string $resource = BookingResource::class;
    // protected static ?string $heading = 'Booking';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    protected function getTableHeading(): string|Htmlable|null
    {
        return view('components.filament.booking-header-notes')->render();
    }
}
