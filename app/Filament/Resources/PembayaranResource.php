<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PembayaranResource\Pages;
use App\Models\Pembayaran;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PembayaranResource extends Resource
{
    protected static ?string $model = Pembayaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationLabel = 'Pembayaran';
    protected static ?string $navigationGroup = 'Transaksi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('booking_id')
                    ->label('Booking')
                    ->relationship('booking', 'id') // atau ubah ke relasi user/lapangan jika perlu tampil nama
                    ->searchable()
                    ->required(),

                Select::make('metode_pembayaran')
                    ->options([
                        'qris' => 'QRIS',
                        'transfer' => 'Transfer Bank',
                        'cash' => 'Tunai',
                    ])
                    ->required(),

                TextInput::make('total')
                    ->label('Total Bayar')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),

                DatePicker::make('paid_at')
                    ->label('Tanggal Pembayaran')
                    ->nullable(),

                Select::make('status')
                    ->options([
                        'waiting' => 'Menunggu',
                        'paid' => 'Disetujui',
                        'failed' => 'Gagal',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('booking.user.name')->label('Pengguna'),
                TextColumn::make('booking.lapangan.nama')->label('Lapangan'),
                TextColumn::make('ket_pembayaran')->label('Keterangan Pembayaran'),
                TextColumn::make('metode_pembayaran')->label('Metode Pembayaran'),
                TextColumn::make('total')->money('IDR'),
                SelectColumn::make('status')
                    ->options([
                        'waiting' => 'Menunggu',
                        'paid' => 'Valid',
                        'failed' => 'Invalid',
                    ])
                    ->sortable()
                    ->searchable(),
                TextColumn::make('paid_at')->label('Dibayar Pada')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPembayarans::route('/'),
            // 'create' => Pages\CreatePembayaran::route('/create'),
            'edit' => Pages\EditPembayaran::route('/{record}/edit'),
        ];
    }
}
