<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bootcamp;
use App\Models\Mentor;
use App\Models\Category;
use App\Http\Requests\Admin\BootcampRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class BootcampController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bootcamps = Bootcamp::with(['mentors', 'category'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.bootcamps.index', compact('bootcamps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mentors = Mentor::where('is_active', true)->get();
        $categories = Category::where('is_active', true)->orderBy('sort_order')->get();

        return view('admin.bootcamps.form', compact('mentors', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BootcampRequest $request)
    {
        $data = $request->validated();

        // Handle array fields
        $arrayFields = ['features', 'curriculum', 'learning_outcomes', 'career_support', 'requirements'];
        foreach ($arrayFields as $field) {
            if (isset($data[$field]) && is_string($data[$field])) {
                // Convert textarea input to array
                $data[$field] = array_filter(explode("\n", $data[$field]));
                // Trim each element and remove empty values
                $data[$field] = array_map('trim', $data[$field]);
                $data[$field] = array_filter($data[$field]);
                // Re-index array
                $data[$field] = array_values($data[$field]);
            }
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('bootcamps', $imageName, 'public');
            $data['image'] = $imageName;
        }

        // Create slug from title
        $data['slug'] = Str::slug($data['title']);

        // Ensure unique slug
        $originalSlug = $data['slug'];
        $counter = 1;
        while (Bootcamp::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        $bootcamp = Bootcamp::create($data);

        // Sync mentors
        if (isset($data['mentors'])) {
            $bootcamp->mentors()->sync($data['mentors']);
        }

        return redirect()
            ->route('admin.bootcamps')
            ->with('success', 'Bootcamp berhasil dibuat!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bootcamp $bootcamp)
    {
        $bootcamp->load(['mentors', 'category']);
        $mentors = Mentor::where('is_active', true)->get();
        $categories = Category::where('is_active', true)->orderBy('sort_order')->get();

        return view('admin.bootcamps.form', compact('bootcamp', 'mentors', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BootcampRequest $request, Bootcamp $bootcamp)
    {
        $data = $request->validated();

        // Handle array fields
        $arrayFields = ['features', 'curriculum', 'learning_outcomes', 'career_support', 'requirements'];
        foreach ($arrayFields as $field) {
            if (isset($data[$field]) && is_string($data[$field])) {
                // Convert textarea input to array
                $data[$field] = array_filter(explode("\n", $data[$field]));
                // Trim each element and remove empty values
                $data[$field] = array_map('trim', $data[$field]);
                $data[$field] = array_filter($data[$field]);
                // Re-index array
                $data[$field] = array_values($data[$field]);
            }
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($bootcamp->image) {
                Storage::disk('public')->delete('bootcamps/' . $bootcamp->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('bootcamps', $imageName, 'public');
            $data['image'] = $imageName;
        }

        // Update slug if title changed
        if ($data['title'] !== $bootcamp->title) {
            $data['slug'] = Str::slug($data['title']);

            // Ensure unique slug
            $originalSlug = $data['slug'];
            $counter = 1;
            while (Bootcamp::where('slug', $data['slug'])->where('id', '!=', $bootcamp->id)->exists()) {
                $data['slug'] = $originalSlug . '-' . $counter;
                $counter++;
            }
        }

        $bootcamp->update($data);

        // Sync mentors
        if (isset($data['mentors'])) {
            $bootcamp->mentors()->sync($data['mentors']);
        } else {
            $bootcamp->mentors()->detach();
        }

        return redirect()
            ->route('admin.bootcamps')
            ->with('success', 'Bootcamp berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bootcamp $bootcamp)
    {
        // Delete image
        if ($bootcamp->image) {
            Storage::disk('public')->delete('bootcamps/' . $bootcamp->image);
        }

        // Detach mentors
        $bootcamp->mentors()->detach();

        // Delete bootcamp
        $bootcamp->delete();

        return redirect()
            ->route('admin.bootcamps')
            ->with('success', 'Bootcamp berhasil dihapus!');
    }

    /**
     * Toggle active status
     */
    public function toggleActive(Bootcamp $bootcamp)
    {
        $bootcamp->is_active = !$bootcamp->is_active;
        $bootcamp->save();

        return redirect()
            ->route('admin.bootcamps')
            ->with('success', 'Status bootcamp berhasil diperbarui!');
    }
}
