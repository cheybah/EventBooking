<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Get all events
    public function index()
    {
        $events = Event::all();

        if ($events->isEmpty()) {
            return response()->json(['message' => 'No event exists.'], 404); //instead having 200 as response status
        } else {
            return response()->json($events);
        }
    }

    // Create a new event
    public function store(Request $request)
    {
        $event = Event::create($request->all());
        return response()->json($event, 201);
    }

    // Get a specific event by ID
    public function show($id)
    {
        $event = Event::find($id);

        if ($event) {
            return response()->json($event);
        } else {
            return response()->json(['message' => 'Event not found'], 404); //instead having 200 as response status here as well
        }
    }

    // Update an existing event
    public function update(Request $request, $id)
    {
        $event = Event::find($id);
        $event->update($request->all());
        return response()->json($event);
    }

    // Delete an event
    public function destroy($id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }
        Event::destroy($id);

        return response()->json(['message' => 'Event deleted successfully'], 200);
    }
}
