<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    // List all blogs
    public function index(Request $request)
    {
        $status = $request->get('status', 'all');

        $query = Blog::with('user')->latest();

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $blogs   = $query->paginate(15);
        $counts  = [
            'all'      => Blog::count(),
            'pending'  => Blog::where('status', 'pending')->count(),
            'accepted' => Blog::where('status', 'accepted')->count(),
            'hidden'   => Blog::where('status', 'hidden')->count(),
        ];

        return view('blog.index', compact('blogs', 'status', 'counts'));
    }

    // Show edit form
    public function edit($id)
    {
        $blog = Blog::with('user')->findOrFail($id);
        return view('blog.edit', compact('blog'));
    }

    // Update blog (admin)
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'status'  => 'required|in:pending,accepted,hidden',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $blog = Blog::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            $blog->image = $request->file('image')->store('blogs', 'public');
        }

        $blog->title   = $request->input('title');
        $blog->content = $request->input('content');
        $blog->status  = $request->input('status');
        $blog->save();

        return redirect()->route('blog.index')
            ->with('success', 'Blog updated successfully.');
    }

    // Accept blog
    public function accept($id)
    {
        Blog::findOrFail($id)->update(['status' => 'accepted']);
        return redirect()->back()->with('success', 'Blog accepted.');
    }

    // Hide blog
    public function hide($id)
    {
        Blog::findOrFail($id)->update(['status' => 'hidden']);
        return redirect()->back()->with('success', 'Blog hidden.');
    }

    // Delete blog (admin)
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return redirect()->back()->with('success', 'Blog deleted.');
    }

    
}