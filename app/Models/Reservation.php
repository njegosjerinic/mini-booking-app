<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'listing_id',
        'start_date',
        'end_date',
    ];

    // Svaka rezervacija pripada jednom korisniku
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Svaka rezervacija pripada jednom smeštaju
    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}
