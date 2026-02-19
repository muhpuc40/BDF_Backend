<?php

namespace App\Http\Controllers;

use App\Models\Committee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommitteeController extends Controller
{
    public function index()
    {
        $committees = Committee::orderBy('priority_level', 'desc')->get();
        return view('committee.index', compact('committees'));
    }

    public function create()
    {
        return view('committee.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'fb_link' => 'nullable|url',
            'gmail' => 'required|email',
            'linkedin_link' => 'nullable|url',
            'priority_level' => 'required|integer|min:0'
        ]);
        
        $data = $request->all();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('committees', 'public');
            $data['image'] = $imagePath;
        }

        Committee::create($data);

        return redirect()->route('committees.index')->with('success', 'Committee member added successfully!');
    }

    public function show(Committee $committee)
    {
        return view('committee.show', compact('committee'));
    }

    /**
     * Show the form for editing the specified committee member.
     */
    public function edit(Committee $committee)
    {
        return view('committee.edit', compact('committee'));
    }

    /**
     * Update the specified committee member in storage.
     */
    public function update(Request $request, Committee $committee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'fb_link' => 'nullable|url',
            'gmail' => 'required|email',
            'linkedin_link' => 'nullable|url',
            'priority_level' => 'required|integer|min:0'
        ]);
        
        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete old image
            if ($committee->image) {
                Storage::disk('public')->delete($committee->image);
            }
            
            $imagePath = $request->file('image')->store('committees', 'public');
            $data['image'] = $imagePath;
        }

        $committee->update($data);

        return redirect()->route('committees.index')->with('success', 'Committee member updated successfully!');
    }

    /**
     * Remove the specified committee member from storage.
     */
    public function destroy(Committee $committee)
    {
        // Delete the image file
        if ($committee->image) {
            Storage::disk('public')->delete($committee->image);
        }
        
        $committee->delete();

        return redirect()->route('committees.index')->with('success', 'Committee member deleted successfully!');
    }

    // API Method
    public function apiIndex()
    {
        $committees = Committee::orderBy('priority_level', 'desc')->get();
        
        return response()->json($committees->map(function ($committee) {
            return [
                'name' => $committee->name,
                'position' => $committee->designation,
                'image' => $committee->image ? asset('storage/' . $committee->image) : null,
                'gmail' => $committee->gmail,
                'facebook' => $committee->fb_link,
                'linkedin' => $committee->linkedin_link
            ];
        }));
    }
}