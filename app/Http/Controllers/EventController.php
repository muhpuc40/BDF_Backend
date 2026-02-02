<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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