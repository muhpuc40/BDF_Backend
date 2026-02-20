<?php

namespace App\Http\Controllers;

use App\Models\Advisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdvisorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $advisors = Advisor::orderBy('created_at', 'desc')->paginate(10);
        return view('advisors.index', compact('advisors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('advisors.create');
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
            $imagePath = $request->file('image')->store('advisors', 'public');
            $validated['image'] = $imagePath;
        }

        Advisor::create($validated);

        return redirect()->route('advisors.index')
            ->with('success', 'Advisor created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Advisor $advisor)
    {
        return view('advisors.show', compact('advisor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Advisor $advisor)
    {
        return view('advisors.edit', compact('advisor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Advisor $advisor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($advisor->image) {
                Storage::disk('public')->delete($advisor->image);
            }
            
            $imagePath = $request->file('image')->store('advisors', 'public');
            $validated['image'] = $imagePath;
        }

        $advisor->update($validated);

        return redirect()->route('advisors.index')
            ->with('success', 'Advisor updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Advisor $advisor)
    {
        // Delete image
        if ($advisor->image) {
            Storage::disk('public')->delete($advisor->image);
        }
        
        $advisor->delete();

        return redirect()->route('advisors.index')
            ->with('success', 'Advisor deleted successfully.');
    }

    /**
     * API: Display a listing of the resource.
     */
    public function apiIndex()
    {
        $advisors = Advisor::orderBy('created_at', 'desc')->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $advisors->map(function ($advisor) {
                return [
                    'id' => $advisor->id,
                    'name' => $advisor->name,
                    'position' => $advisor->position,
                    'image' => $advisor->image ? asset('storage/' . $advisor->image) : null,
                    'created_at' => $advisor->created_at,
                    'updated_at' => $advisor->updated_at,
                ];
            })
        ]);
    }
}