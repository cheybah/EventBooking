<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'category' ,'event_date', 'available_seats' ,'booked_seats', 'img'
    ]; //To prevent mass assignment exception. Define user input.

    // Define the relationship: an event has many bookings
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
