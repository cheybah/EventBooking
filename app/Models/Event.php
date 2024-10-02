<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'event_date', 'location', 'available_seats'
    ]; //To prevent mass assignment exception. Define user input.

    // Define the relationship: an event has many bookings
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
