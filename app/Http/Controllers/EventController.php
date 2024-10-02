<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Get all events
    public function index()
    {
        return response()->json(Event::all());
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
        return response()->json(Event::find($id));
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
        Event::destroy($id);
        return response()->json(null, 204);
    }
}
