<?php

namespace App\Http\Controllers;

use App\Models\Directory;
use Illuminate\Http\Request;

class DirectoryController extends Controller
{
    // Web Methods
    public function index()
    {
        $directories = Directory::all();
        return view('directory.index', compact('directories'));
    }

    public function create()
    {
        return view('directory.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'club_name' => 'required|string|max:255',
            'university' => 'required|string|max:255',
            'president' => 'required|string|max:255',
            'general_secretary' => 'required|string|max:255',
            'contact' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'location' => 'required|string|max:255',
            'established' => 'required|string|max:10',
            'members' => 'required|string|max:10',
            'status' => 'required|in:Active,Inactive,Suspended',
            'facebook_url' => 'nullable|url|max:255',
        ]);

        Directory::create($validated);

        return redirect()->route('directory.index')
            ->with('success', 'Directory entry created successfully.');
    }

    public function show(Directory $directory)
    {
        return view('directory.show', compact('directory'));
    }

    // API Method
    public function apiIndex()
    {
        $directories = Directory::all();
        return response()->json($directories);
    }
}