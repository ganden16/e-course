<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with('productCategory');

        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('product_category_id', $request->category);
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('is_active', $request->status === 'active');
        }

        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('instructor', 'like', '%' . $request->search . '%');
            });
        }

        $products = $query->orderBy('created_at', 'desc')->paginate(10);
        $categories = ProductCategory::where('is_active', true)->orderBy('updated_at', 'desc')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ProductCategory::where('is_active', true)->orderBy('updated_at', 'desc')->get();
        return view('admin.products.form', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'product_category_id' => 'required|exists:product_categories,id',
            // 'instructor' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'original_price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rating' => 'required|numeric|min:0|max:5',
            'students' => 'required|integer|min:0',
            'duration' => 'required|string|max:255',
            'level' => 'required|string|max:255',
            'description' => 'required|string',
            'features' => 'nullable|array',
            'curriculum' => 'nullable|array',
            'requirements' => 'nullable|array',
            'what_you_will_build' => 'nullable|array',
            'is_active' => 'string',
            'lynkid' => 'nullable|string'
        ]);

        $data = $request->except('image');

        if(isset($data['is_active'])) {
            $data['is_active'] = true;
        }else{
            $data['is_active'] = false;
        }

        // Create slug from title
        $data['slug'] = Str::slug($data['title']);

        // Ensure unique slug
        $originalSlug = $data['slug'];
        $counter = 1;
        while (Product::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/products', $imageName);
            $data['image'] = url('storage/products/' . $imageName);
        }

        // Set default values
        $data['is_active'] = $request->has('is_active') ? true : false;

        Product::create($data);

        return redirect()
            ->back()
            ->with('success', 'Product created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = ProductCategory::where('is_active', true)->orderBy('updated_at', 'desc')->get();
        return view('admin.products.form', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'product_category_id' => 'required|exists:product_categories,id',
            // 'instructor' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'original_price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rating' => 'required|numeric|min:0|max:5',
            'students' => 'required|integer|min:0',
            'duration' => 'required|string|max:255',
            'level' => 'required|string|max:255',
            'description' => 'required|string',
            'features' => 'nullable|array',
            'curriculum' => 'nullable|array',
            'requirements' => 'nullable|array',
            'what_you_will_build' => 'nullable|array',
            'is_active' => 'string',
            'lynkid' => 'nullable|string'
        ]);

        $data = $request->except('image');

        if(isset($data['is_active'])) {
            $data['is_active'] = true;
        }else{
            $data['is_active'] = false;
        }

        // Update slug if title changed
        if ($data['title'] !== $product->title) {
            $data['slug'] = Str::slug($data['title']);

            // Ensure unique slug
            $originalSlug = $data['slug'];
            $counter = 1;
            while (Product::where('slug', $data['slug'])->where('id', '!=', $product->id)->exists()) {
                $data['slug'] = $originalSlug . '-' . $counter;
                $counter++;
            }
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image) {
                // Extract filename from full URL if it's a full URL
                $imagePath = $product->image;
                if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
                    $imagePath = basename(parse_url($imagePath, PHP_URL_PATH));
                }
                Storage::delete('public/products/' . $imagePath);
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/products', $imageName);
            $data['image'] = url('storage/products/' . $imageName);
        }

        // Set default values
        $data['is_active'] = $request->has('is_active') ? true : false;

        $product->update($data);

        return redirect()
            ->back()
            ->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Delete image
        if ($product->image) {
            // Extract filename from full URL if it's a full URL
            $imagePath = $product->image;
            if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
                $imagePath = basename(parse_url($imagePath, PHP_URL_PATH));
            }
            Storage::delete('public/products/' . $imagePath);
        }

        $product->delete();

        return redirect()
            ->route('admin.products')
            ->with('success', 'Product deleted successfully!');
    }

    /**
     * Toggle active status
     */
    public function toggleActive(Product $product)
    {
        $product->is_active = !$product->is_active;
        $product->save();

        return redirect()->back()->with('success', 'Status product berhasil diperbarui!');
    }
}
