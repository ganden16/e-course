<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ProductCategory::withCount('products');

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('is_active', $request->status === 'active');
        }

        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $categories = $query->orderBy('name', 'asc')
            ->paginate(10);

        return view('admin.product-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product-categories.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        // Create slug from name
        $data['slug'] = Str::slug($data['name']);

        // Ensure unique slug
        $originalSlug = $data['slug'];
        $counter = 1;
        while (ProductCategory::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Set default values
        $data['is_active'] = $request->has('is_active') ? true : false;

        ProductCategory::create($data);

        return redirect()
            ->route('admin.product-categories')
            ->with('success', 'Product category created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductCategory $productCategory)
    {
        return view('admin.product-categories.form', compact('productCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductCategory $productCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        // Update slug if name changed
        if ($data['name'] !== $productCategory->name) {
            $data['slug'] = Str::slug($data['name']);

            // Ensure unique slug
            $originalSlug = $data['slug'];
            $counter = 1;
            while (ProductCategory::where('slug', $data['slug'])->where('id', '!=', $productCategory->id)->exists()) {
                $data['slug'] = $originalSlug . '-' . $counter;
                $counter++;
            }
        }

        // Set default values
        $data['is_active'] = $request->has('is_active') ? true : false;

        $productCategory->update($data);

        return redirect()
            ->back()
            ->with('success', 'Product category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $productCategory)
    {
        // Check if category has products
        if ($productCategory->products()->count() > 0) {
            return redirect()
                ->back()
                ->with('error', 'Category cannot be deleted because it still has products!');
        }

        $productCategory->delete();

        return redirect()
            ->back()
            ->with('success', 'Product category deleted successfully!');
    }

    /**
     * Toggle active status
     */
    public function toggleActive(ProductCategory $productCategory)
    {
        $productCategory->is_active = !$productCategory->is_active;
        $productCategory->save();

        return redirect()->back()->with('success', 'Status kategori berhasil diperbarui!');
    }

}
