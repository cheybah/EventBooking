<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // Get all bookings for an event
    public function index($eventId)
    {
        return response()->json(Booking::where('event_id', $eventId)->get());
    }

    // Create a new booking
    public function store(Request $request)
    {
        $booking = Booking::create($request->all());
        // Update booked seats in the event
        $event = Event::find($request->event_id);
        $event->booked_seats += $request->seats_reserve;
        $event->save();

        return response()->json($booking, 201);
    }

    // Delete a booking
    public function destroy($id)
    {
        Booking::destroy($id);
        return response()->json(null, 204);
    }
}
