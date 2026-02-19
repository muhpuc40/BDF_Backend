<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Add this at the top

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('date', 'desc')->paginate(10);
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'nullable',
            'location' => 'required|string|max:255',
            'type' => 'required|string|in:upcoming,ongoing,completed',
            'category' => 'required|string|in:training,international,national',
            'participants' => 'nullable|string|max:100',
            'registration_deadline' => 'nullable|date',
            'status' => 'nullable|string|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
            $validated['image'] = $imagePath;
        }

        Event::create($validated);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified event.
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified event in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'nullable',
            'location' => 'required|string|max:255',
            'type' => 'required|string|in:upcoming,ongoing,completed',
            'category' => 'required|string|in:training,international,national',
            'participants' => 'nullable|string|max:100',
            'registration_deadline' => 'nullable|date',
            'status' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            
            $imagePath = $request->file('image')->store('events', 'public');
            $validated['image'] = $imagePath;
        }

        $event->update($validated);

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified event from storage.
     */
    public function destroy(Event $event)
    {
        // Delete the image file
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }
        
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }

    public function apiIndex()
    {
        $events = Event::orderBy('date', 'desc')->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $events->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'description' => $item->description,
                    'date' => $item->date,
                    'time' => $item->time,
                    'location' => $item->location,
                    'type' => $item->type,
                    'category' => $item->category,
                    'participants' => $item->participants,
                    'registration_deadline' => $item->registration_deadline,
                    'status' => $item->status,
                    'image' => $item->image ? asset('storage/' . $item->image) : null,
                    'created_at' => $item->created_at,
                ];
            })
        ]);
    }
}