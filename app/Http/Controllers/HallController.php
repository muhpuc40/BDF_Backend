<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HallController extends Controller
{
    public function index()
    {
        $halls = Hall::orderBy('id', 'desc')->get();
        return view('hall.index', compact('halls'));
    }

    public function create()
    {
        return view('hall.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'ec' => 'nullable|string|max:255',
            'president' => 'required|string|max:255',
            'secretary' => 'required|string|max:255',
            'president_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'secretary_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('president_image')) {
            $data['president_image'] = $request->file('president_image')->store('hall', 'public');
        }

        if ($request->hasFile('secretary_image')) {
            $data['secretary_image'] = $request->file('secretary_image')->store('hall', 'public');
        }

        Hall::create($data);

        return redirect()->route('hall.index')->with('success', 'Hall entry created successfully!');
    }

    public function show(Hall $hall)
    {
        return view('hall.show', compact('hall'));
    }

    public function apiIndex()
    {
        $halls = Hall::orderBy('id', 'desc')->get();
        
        return response()->json($halls->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'ec' => $item->ec,
                'president' => $item->president,
                'secretary' => $item->secretary,
                'presidentImage' => $item->president_image ? asset('storage/' . $item->president_image) : null,
                'secretaryImage' => $item->secretary_image ? asset('storage/' . $item->secretary_image) : null,
            ];
        }));
    }
}