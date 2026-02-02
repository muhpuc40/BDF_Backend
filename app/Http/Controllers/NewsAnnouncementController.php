<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsAnnouncementController extends Controller
{
    // News Methods
    public function newsIndex()
    {
        $news = News::orderBy('date', 'desc')->paginate(10);
        return view('news.index', compact('news'));
    }

    public function newsCreate()
    {
        return view('news.create');
    }

    public function newsStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'category' => 'required|string|max:100',
            'date' => 'required|date',
            'author' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'read_time' => 'required|string|max:50',
            'tags' => 'nullable|string'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news', 'public');
            $validated['image'] = $imagePath;
        }

        // Convert tags from comma-separated string to array
        if ($request->has('tags')) {
            $tags = explode(',', $request->tags);
            $validated['tags'] = array_map('trim', $tags);
        }

        News::create($validated);

        return redirect()->route('news.index')->with('success', 'News created successfully.');
    }

    public function newsShow(News $news)
    {
        return view('news.show', compact('news'));
    }

    // Announcement Methods
    public function announcementIndex()
    {
        $announcements = Announcement::orderBy('created_at', 'desc')->paginate(10);
        return view('announcements.index', compact('announcements'));
    }

    public function announcementCreate()
    {
        $iconClasses = [
            'fas fa-exclamation-triangle text-red-500',
            'fas fa-info-circle text-blue-500',
            'fas fa-exclamation-circle text-yellow-500',
            'fas fa-check-circle text-green-500',
            'fas fa-bullhorn text-purple-500'
        ];
        
        return view('announcements.create', compact('iconClasses'));
    }

    public function announcementStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'time_ago' => 'required|string|max:100',
            'type' => 'required|string|in:urgent,info,warning,success',
            'icon_class' => 'required|string|max:100'
        ]);

        Announcement::create($validated);

        return redirect()->route('announcements.index')->with('success', 'Announcement created successfully.');
    }

    public function announcementShow(Announcement $announcement)
    {
        return view('announcements.show', compact('announcement'));
    }


public function apiNews()
{
    $news = News::orderBy('date', 'desc')->get();
    
    return response()->json([
        'status' => 'success',
        'data' => $news->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'excerpt' => $item->excerpt,
                'content' => $item->content,
                'category' => $item->category,
                'date' => $item->date,
                'author' => $item->author,
                'image' => $item->image ? asset('storage/' . $item->image) : null,
                'read_time' => $item->read_time,
                'tags' => $item->tags,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        })
    ]);
}

    public function apiAnnouncements()
    {
        $announcements = Announcement::orderBy('created_at', 'desc')->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $announcements
        ]);
    }
}