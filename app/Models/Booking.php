<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id', 'client_name', 'seats_reserve'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
