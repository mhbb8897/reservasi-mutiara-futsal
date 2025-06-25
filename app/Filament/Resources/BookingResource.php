<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Data Booking';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('Pengguna')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('lapangan_id')
                    ->label('Lapangan')
                    ->relationship('lapangan', 'nama')
                    ->required(),
                DatePicker::make('tanggal_booking')
                    ->label('Tanggal Booking')
                    ->required(),
                TimePicker::make('waktu_mulai')->label('Waktu Mulai')->required(),
                TimePicker::make('waktu_selesai')->label('Waktu Selesai')->required(),
                Select::make('nominal')
                    ->label('Nominal')
                    ->options([
                        '10000' => 'Rp 10.000',
                        '75000' => 'Rp 75.000',
                        '150000' => 'Rp 150.000',
                    ])
                    ->required(),
                ToggleButtons::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Disetujui',
                        'cancelled' => 'Dibatalkan',
                    ])
                    ->inline()
                    ->default('pending')
                    ->required()
                    ->colors([
                        'pending' => 'warning',
                        'confirmed' => 'success',
                        'cancelled' => 'danger',
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('Pengguna')->searchable(),
                TextColumn::make('lapangan.nama')->label('Lapangan')->searchable(),
                TextColumn::make('tanggal_booking')->label('Tanggal')->sortable(),
                TextColumn::make('waktu_mulai')->label('Mulai'),
                TextColumn::make('waktu_selesai')->label('Selesai'),
                SelectColumn::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Disetujui',
                        'cancelled' => 'Dibatalkan',
                    ])
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListBookings::route('/'),
            // 'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
