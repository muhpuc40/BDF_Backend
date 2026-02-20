<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Announcement;
use Illuminate\Http\Request;

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
            'content' => 'required|string',
            'category' => 'nullable|string|max:100',
            'date' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
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

    public function newsEdit(News $news)
    {
        return view('news.edit', compact('news'));
    }

    public function newsUpdate(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'nullable|string|max:100',
            'date' => 'required|date',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'nullable|string'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($news->image) {
                \Storage::disk('public')->delete($news->image);
            }
            $imagePath = $request->file('image')->store('news', 'public');
            $validated['image'] = $imagePath;
        }

        // Convert tags from comma-separated string to array
        if ($request->has('tags')) {
            $tags = explode(',', $request->tags);
            $validated['tags'] = array_map('trim', $tags);
        }

        $news->update($validated);

        return redirect()->route('news.index')->with('success', 'News updated successfully.');
    }

    public function newsDestroy(News $news)
    {
        // Delete image if exists
        if ($news->image) {
            \Storage::disk('public')->delete($news->image);
        }
        
        $news->delete();
        return redirect()->route('news.index')->with('success', 'News deleted successfully.');
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

    public function announcementEdit(Announcement $announcement)
    {
        $iconClasses = [
            'fas fa-exclamation-triangle text-red-500',
            'fas fa-info-circle text-blue-500',
            'fas fa-exclamation-circle text-yellow-500',
            'fas fa-check-circle text-green-500',
            'fas fa-bullhorn text-purple-500'
        ];
        
        return view('announcements.edit', compact('announcement', 'iconClasses'));
    }

    public function announcementUpdate(Request $request, Announcement $announcement)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'time_ago' => 'required|string|max:100',
            'type' => 'required|string|in:urgent,info,warning,success',
            'icon_class' => 'required|string|max:100'
        ]);

        $announcement->update($validated);

        return redirect()->route('announcements.index')->with('success', 'Announcement updated successfully.');
    }

    public function announcementDestroy(Announcement $announcement)
    {
        $announcement->delete();
        return redirect()->route('announcements.index')->with('success', 'Announcement deleted successfully.');
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
                    'content' => $item->content,
                    'category' => $item->category,
                    'date' => $item->date ? $item->date->format('M d, Y') : null,
                    'image' => $item->image ? asset('storage/' . $item->image) : null,
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