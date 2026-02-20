<?php

namespace App\Http\Controllers;

use App\Models\Presidium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PresidiumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presidium = Presidium::orderBy('created_at', 'desc')->paginate(10);
        return view('presidium.index', compact('presidium'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('presidium.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('presidium', 'public');
            $validated['image'] = $imagePath;
        }

        Presidium::create($validated);

        return redirect()->route('presidium.index')
            ->with('success', 'Presidium member created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Presidium $presidium)
    {
        return view('presidium.show', compact('presidium'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Presidium $presidium)
    {
        return view('presidium.edit', compact('presidium'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Presidium $presidium)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($presidium->image) {
                Storage::disk('public')->delete($presidium->image);
            }
            
            $imagePath = $request->file('image')->store('presidium', 'public');
            $validated['image'] = $imagePath;
        }

        $presidium->update($validated);

        return redirect()->route('presidium.index')
            ->with('success', 'Presidium member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Presidium $presidium)
    {
        // Delete image
        if ($presidium->image) {
            Storage::disk('public')->delete($presidium->image);
        }
        
        $presidium->delete();

        return redirect()->route('presidium.index')
            ->with('success', 'Presidium member deleted successfully.');
    }

    /**
     * API: Display a listing of the resource.
     */
    public function apiIndex()
    {
        $presidium = Presidium::orderBy('created_at', 'desc')->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $presidium->map(function ($member) {
                return [
                    'id' => $member->id,
                    'name' => $member->name,
                    'position' => $member->position,
                    'image' => $member->image ? asset('storage/' . $member->image) : null,
                    'created_at' => $member->created_at,
                    'updated_at' => $member->updated_at,
                ];
            })
        ]);
    }
}