<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index(Request $request)
    {
        $locale = app()->getLocale();
        $translations = include lang_path("{$locale}/product.php");
        $course_details = $translations['course_details'];
        $load_more = $translations['load_more'];

        $query = Product::with('productCategory')->where('is_active', true);

        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $category = ProductCategory::where('slug', $request->category)->first();
            if ($category) {
                $query->where('product_category_id', $category->id);
            }
        }

        // Sort products
        switch ($request->get('sort', 'default')) {
            case 'price-low':
                $query->orderBy('price', 'asc');
                break;
            case 'price-high':
                $query->orderBy('price', 'desc');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            case 'students':
                $query->orderBy('students', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        // Get total count before applying pagination/limit
        $totalProducts = $query->count();

        // Handle AJAX request for load more functionality
        if ($request->ajax()) {
            $page = $request->get('page', 1);
            $offset = ($page - 1) * 6; // Load 6 items per click
            $products = $query->skip($offset)->take(6)->get();

            return response()->json([
                'html' => view('partials.product-items', compact('products', 'course_details'))->render(),
                'hasMore' => $totalProducts > ($offset + 6)
            ]);
        }

        // Initial load - show first 6 items
        $products = $query->take(6)->get();
        $categories = ProductCategory::where('is_active', true)->orderBy('sort_order')->get();

        return view('product', compact('products', 'categories', 'totalProducts', 'course_details', 'load_more'));
    }

    /**
     * Display the specified product.
     */
    public function show($locale, $id)
    {
        $product = Product::with('productCategory')->where('id', $id)->where('is_active', true)->first();

        if (!$product) {
            abort(404);
        }

        // Get related products (same category, excluding current product)
        $relatedProducts = Product::where('product_category_id', $product->product_category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->limit(3)
            ->get();

        // Get other products (excluding current product and related products)
        $otherProducts = Product::where('id', '!=', $product->id)
            ->whereNotIn('id', $relatedProducts->pluck('id'))
            ->where('is_active', true)
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return view('product-detail', compact('product', 'relatedProducts', 'otherProducts'));
    }

    /**
     * Display a listing of the products for admin.
     */
    public function adminIndex()
    {
        $products = Product::with('productCategory')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = ProductCategory::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.products.form', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'product_category_id' => 'required|exists:product_categories,id',
            'instructor' => 'required|string|max:255',
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
            'is_active' => 'boolean',
        ]);

        $data = $request->except('image');

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/products', $imageName);
            $data['image'] = 'products/' . $imageName;
        }

        // Convert arrays to JSON
        if ($request->has('features')) {
            $data['features'] = json_encode($request->features);
        }
        if ($request->has('curriculum')) {
            $data['curriculum'] = json_encode($request->curriculum);
        }
        if ($request->has('requirements')) {
            $data['requirements'] = json_encode($request->requirements);
        }
        if ($request->has('what_you_will_build')) {
            $data['what_you_will_build'] = json_encode($request->what_you_will_build);
        }

        Product::create($data);

        return redirect()->route('admin.products')
            ->with('success', 'Product created successfully!');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        $categories = ProductCategory::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.products.form', compact('product', 'categories'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'product_category_id' => 'required|exists:product_categories,id',
            'instructor' => 'required|string|max:255',
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
            'is_active' => 'boolean',
        ]);

        $data = $request->except('image');

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image) {
                Storage::delete('public/' . $product->image);
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/products', $imageName);
            $data['image'] = 'products/' . $imageName;
        }

        // Convert arrays to JSON
        if ($request->has('features')) {
            $data['features'] = json_encode($request->features);
        }
        if ($request->has('curriculum')) {
            $data['curriculum'] = json_encode($request->curriculum);
        }
        if ($request->has('requirements')) {
            $data['requirements'] = json_encode($request->requirements);
        }
        if ($request->has('what_you_will_build')) {
            $data['what_you_will_build'] = json_encode($request->what_you_will_build);
        }

        $product->update($data);

        return redirect()->route('admin.products')
            ->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        // Delete image
        if ($product->image) {
            Storage::delete('public/' . $product->image);
        }

        $product->delete();

        return redirect()->route('admin.products')
            ->with('success', 'Product deleted successfully!');
    }

    /**
     * Toggle the active status of the specified product.
     */
    public function toggleActive(Product $product)
    {
        $product->is_active = !$product->is_active;
        $product->save();

        return response()->json([
            'success' => true,
            'is_active' => $product->is_active
        ]);
    }
}
