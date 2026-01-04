<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogTag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Blog::with(['tags']);

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('is_active', $request->status === 'active');
        }

        // Search
        if ($request->has('search') && $request->search !== '') {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%')
                  ->orWhere('author', 'like', '%' . $request->search . '%');
            });
        }

        $blogs = $query->orderBy('published_at', 'desc')->paginate(10);

        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = BlogTag::all();

        return view('admin.blogs.form', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'published_at' => 'required|date',
            'read_time' => 'required|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:blog_tags,id',
            // 'is_active' => 'boolean'
        ]);

        $data = $request->except(['image', 'tags']);

        // Create slug from title
        $data['slug'] = Str::slug($data['title']);

        // Ensure unique slug
        $originalSlug = $data['slug'];
        $counter = 1;
        while (Blog::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('blogs', $imageName, 'public');
            $data['image'] = url('storage/blogs/' . $imageName);
        }

        $blog = Blog::create($data);

        // Sync tags
        if ($request->has('tags')) {
            $blog->tags()->sync($request->tags);
        }

        return redirect()
            ->route('admin.blogs')
            ->with('success', 'Blog berhasil dibuat!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $tags = BlogTag::all();
        $blogTags = $blog->tags->pluck('id')->toArray();

        return view('admin.blogs.form', compact('blog', 'tags', 'blogTags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'published_at' => 'required|date',
            'read_time' => 'required|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:blog_tags,id',
            'is_active' => 'string'
        ]);

        $data = $request->except(['image', 'tags']);

        if(isset($data['is_active'])) {
            $data['is_active'] = true;
        }else{
            $data['is_active'] = false;
        }

        // Update slug if title changed
        if ($data['title'] !== $blog->title) {
            $data['slug'] = Str::slug($data['title']);

            // Ensure unique slug
            $originalSlug = $data['slug'];
            $counter = 1;
            while (Blog::where('slug', $data['slug'])->where('id', '!=', $blog->id)->exists()) {
                $data['slug'] = $originalSlug . '-' . $counter;
                $counter++;
            }
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($blog->image) {
                // Extract filename from full URL if it's a full URL
                $imagePath = $blog->image;
                if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
                    $imagePath = basename(parse_url($imagePath, PHP_URL_PATH));
                }
                Storage::disk('public')->delete('blogs/' . $imagePath);
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('blogs', $imageName, 'public');
            $data['image'] = url('storage/blogs/' . $imageName);
        }

        $blog->update($data);

        // Sync tags
        if ($request->has('tags')) {
            $blog->tags()->sync($request->tags);
        } else {
            $blog->tags()->detach();
        }

        return redirect()
            ->back()
            ->with('success', 'Blog berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        // Delete image
        if ($blog->image) {
            // Extract filename from full URL if it's a full URL
            $imagePath = $blog->image;
            if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
                $imagePath = basename(parse_url($imagePath, PHP_URL_PATH));
            }
            Storage::disk('public')->delete('blogs/' . $imagePath);
        }

        $blog->tags()->detach();
        $blog->delete();

        return redirect()
            ->back()
            ->with('success', 'Blog berhasil dihapus!');
    }

    /**
     * Toggle active status
     */
    public function toggleActive(Blog $blog)
    {
        $blog->is_active = !$blog->is_active;
        $blog->save();

        return redirect()
            ->back()
            ->with('success', 'Status blog berhasil diperbarui!');
    }
}
