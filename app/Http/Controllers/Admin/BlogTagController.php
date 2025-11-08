<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogTag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogTagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = BlogTag::withCount('blogs');

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('is_active', $request->status === 'active');
        }

        // Search
        if ($request->has('search') && $request->search !== '') {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $tags = $query->orderBy('name', 'asc')->paginate(10);

        return view('admin.blog-tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog-tags.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:blog_tags,name',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        // Create slug from name
        $data['slug'] = Str::slug($data['name']);

        // Ensure unique slug
        $originalSlug = $data['slug'];
        $counter = 1;
        while (BlogTag::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        BlogTag::create($data);

        return redirect()
            ->route('admin.blog-tags')
            ->with('success', 'Tag blog berhasil dibuat!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogTag $blogTag)
    {
        return view('admin.blog-tags.form', compact('blogTag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogTag $blogTag)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:blog_tags,name,' . $blogTag->id,
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        // Update slug if name changed
        if ($data['name'] !== $blogTag->name) {
            $data['slug'] = Str::slug($data['name']);

            // Ensure unique slug
            $originalSlug = $data['slug'];
            $counter = 1;
            while (BlogTag::where('slug', $data['slug'])->where('id', '!=', $blogTag->id)->exists()) {
                $data['slug'] = $originalSlug . '-' . $counter;
                $counter++;
            }
        }

        $blogTag->update($data);

        return redirect()
            ->route('admin.blog-tags')
            ->with('success', 'Tag blog berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogTag $blogTag)
    {
        // Check if tag has blogs
        if ($blogTag->blogs()->count() > 0) {
            return redirect()
                ->route('admin.blog-tags')
                ->with('error', 'Tag blog tidak dapat dihapus karena masih memiliki blog!');
        }

        $blogTag->delete();

        return redirect()
            ->route('admin.blog-tags')
            ->with('success', 'Tag blog berhasil dihapus!');
    }
}
