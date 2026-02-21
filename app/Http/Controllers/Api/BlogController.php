<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class BlogController extends Controller
{
    // GET /api/blogs — public, only accepted blogs
    public function index()
    {
        $blogs = Blog::with('user:id,full_name')
            ->where('status', 'accepted')
            ->latest()
            ->get()
            ->map(fn($blog) => $this->formatBlog($blog));

        return response()->json($blogs);
    }

    // POST /api/blogs — create, status = pending
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user = JWTAuth::parseToken()->authenticate();

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blogs', 'public');
        }

        $blog = Blog::create([
            'user_id' => $user->id,
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'image' => $imagePath,
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Blog submitted for review.',
            'blog' => $this->formatBlog($blog->load('user')),
        ], 201);
    }

    // PUT /api/blogs/{id} — user edits own blog, resets to pending
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user = JWTAuth::parseToken()->authenticate();
        $blog = Blog::findOrFail($id);

        if ($blog->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        if ($request->hasFile('image')) {
            if ($blog->image) {
                \Storage::disk('public')->delete($blog->image);
            }
            $blog->image = $request->file('image')->store('blogs', 'public');
        }

        $blog->title = $request->input('title');
        $blog->content = $request->input('content');
        $blog->status = 'pending'; // reset to pending after edit
        $blog->save();

        return response()->json([
            'message' => 'Blog updated and resubmitted for review.',
            'blog' => $this->formatBlog($blog->load('user')),
        ]);
    }

    // DELETE /api/blogs/{id} — user deletes own blog
    public function destroy($id)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $blog = Blog::findOrFail($id);

        if ($blog->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        $this->deleteImage($blog);
        $blog->delete();

        return response()->json(['message' => 'Blog deleted successfully.']);
    }

    // ── Private helper ──
    private function formatBlog($blog)
    {
        return [
            'id' => $blog->id,
            'title' => $blog->title,
            'content' => $blog->content,
            'image' => $blog->image ? asset('storage/' . $blog->image) : null,
            'status' => $blog->status,
            'author' => $blog->user->full_name ?? 'Unknown',
            'user_id' => $blog->user_id,
            'created_at' => $blog->created_at->format('d M Y'),
        ];
    }

    private function deleteImage($blog)
    {
        if ($blog->image) {
            \Storage::disk('public')->delete($blog->image);
        }
    }


    // GET /api/blogs/my — returns logged-in user's own blogs (all statuses)
    public function myBlogs()
    {
        $user = JWTAuth::parseToken()->authenticate();

        $blogs = Blog::with('user:id,full_name')
            ->where('user_id', $user->id)
            ->latest()
            ->get()
            ->map(fn($blog) => $this->formatBlog($blog));

        return response()->json($blogs);
    }
}