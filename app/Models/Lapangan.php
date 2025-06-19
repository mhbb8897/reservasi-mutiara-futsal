<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'deskripsi',
        'harga_per_jam',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function getFirstImageAttribute()
    {
        return isset($this->images[0]) ? asset('storage/' . ltrim($this->images[0], '/')) : null;
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
