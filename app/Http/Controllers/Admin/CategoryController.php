<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\Admin\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('sort_order', 'asc')
            ->orderBy('name', 'asc')
            ->withCount('bootcamps')
            ->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();

        // Create slug from title
        $data['slug'] = Str::slug($data['name']);

        // Ensure unique slug
        $originalSlug = $data['slug'];
        $counter = 1;
        while (Category::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        Category::create($data);

        return redirect()
            ->route('admin.categories')
            ->with('success', 'Kategori berhasil dibuat!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.form', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->validated();

        // Update slug if name changed
        if ($data['name'] !== $category->name) {
            $data['slug'] = Str::slug($data['name']);

            // Ensure unique slug
            $originalSlug = $data['slug'];
            $counter = 1;
            while (Category::where('slug', $data['slug'])->where('id', '!=', $category->id)->exists()) {
                $data['slug'] = $originalSlug . '-' . $counter;
                $counter++;
            }
        }

        $category->update($data);

        return redirect()
            ->route('admin.categories')
            ->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Check if category has bootcamps
        if ($category->bootcamps()->count() > 0) {
            return redirect()
                ->route('admin.categories')
                ->with('error', 'Kategori tidak dapat dihapus karena masih memiliki bootcamp!');
        }

        $category->delete();

        return redirect()
            ->route('admin.categories')
            ->with('success', 'Kategori berhasil dihapus!');
    }

    /**
     * Toggle active status
     */
    public function toggleActive(Category $category)
    {
        $category->is_active = !$category->is_active;
        $category->save();

        return redirect()
            ->route('admin.categories')
            ->with('success', 'Status kategori berhasil diperbarui!');
    }

    /**
     * Update sort order
     */
    public function updateSort(Request $request)
    {
        $data = $request->validate([
            'categories' => 'required|array',
            'categories.*.id' => 'required|exists:categories,id',
            'categories.*.sort_order' => 'required|integer|min:0'
        ]);

        foreach ($data['categories'] as $categoryData) {
            Category::where('id', $categoryData['id'])
                ->update(['sort_order' => $categoryData['sort_order']]);
        }

        return response()->json(['success' => true]);
    }
}
