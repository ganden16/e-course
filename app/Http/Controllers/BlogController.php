<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogTag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the blogs.
     */
    public function index(Request $request)
    {
        $locale = app()->getLocale();
        $translations = include lang_path("{$locale}/blog.php");

        $query = Blog::with(['tags'])
            ->active()
            ->latest();

        // Filter by tag
        if ($request->has('tag') && $request->tag !== '') {
            $query->whereHas('tags', function($q) use ($request) {
                $q->where('slug', $request->tag);
            });
        }

        // Sort
        if ($request->has('sort')) {
            if ($request->sort === 'oldest') {
                $query->oldest('published_at');
            }
        }

        $blogs = $query->paginate(9);
        $tags = BlogTag::active()->get();

        return view('blog', compact('blogs', 'tags', 'translations'));
    }

    /**
     * Display the specified blog.
     */
    public function show($locale, $slug)
    {
        $blog = Blog::with(['tags'])
            ->active()
            ->where('slug', $slug)
            ->firstOrFail();

        // Get related blogs
        $relatedBlogs = $blog->relatedBlogs(3);

        // Get other blogs (excluding current and related)
        $otherBlogs = Blog::with(['tags'])
            ->active()
            ->where('id', '!=', $blog->id)
            ->whereNotIn('id', $relatedBlogs->pluck('id'))
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return view('blog-detail', compact('blog', 'relatedBlogs', 'otherBlogs'));
    }
}
