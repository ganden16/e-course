<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mentor;
use App\Http\Requests\Admin\MentorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class MentorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Mentor::query();

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('is_active', $request->status === 'active');
        }

        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('specialization', 'like', '%' . $request->search . '%')
                  ->orWhere('experience', 'like', '%' . $request->search . '%')
                  ->orWhere('phone', 'like', '%' . $request->search . '%');
            });
        }

        $mentors = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.mentors.index', compact('mentors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.mentors.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MentorRequest $request)
    {
        $data = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('mentors', $imageName, 'public');
            $data['image'] = url('storage/mentors/' . $imageName);
        }

        // Create slug from name
        $data['slug'] = Str::slug($data['name']);

        // Ensure unique slug
        $originalSlug = $data['slug'];
        $counter = 1;
        while (Mentor::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Set default values
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        Mentor::create($data);

        return redirect()
            ->route('admin.mentors')
            ->with('success', 'Mentor berhasil dibuat!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mentor $mentor)
    {
        return view('admin.mentors.form', compact('mentor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MentorRequest $request, Mentor $mentor)
    {
        $data = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($mentor->image) {
                // Extract filename from full URL if it's a full URL
                $imagePath = $mentor->image;
                if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
                    $imagePath = basename(parse_url($imagePath, PHP_URL_PATH));
                }
                Storage::disk('public')->delete('mentors/' . $imagePath);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('mentors', $imageName, 'public');
            $data['image'] = url('storage/mentors/' . $imageName);
        }

        // Update slug if name changed
        if ($data['name'] !== $mentor->name) {
            $data['slug'] = Str::slug($data['name']);

            // Ensure unique slug
            $originalSlug = $data['slug'];
            $counter = 1;
            while (Mentor::where('slug', $data['slug'])->where('id', '!=', $mentor->id)->exists()) {
                $data['slug'] = $originalSlug . '-' . $counter;
                $counter++;
            }
        }

        // Set is_active value
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $mentor->update($data);

        return redirect()
            ->route('admin.mentors')
            ->with('success', 'Mentor berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mentor $mentor)
    {
        // Delete image
        if ($mentor->image) {
            // Extract filename from full URL if it's a full URL
            $imagePath = $mentor->image;
            if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
                $imagePath = basename(parse_url($imagePath, PHP_URL_PATH));
            }
            Storage::disk('public')->delete('mentors/' . $imagePath);
        }

        // Detach from bootcamps
        $mentor->bootcamps()->detach();

        // Delete mentor
        $mentor->delete();

        return redirect()
            ->route('admin.mentors')
            ->with('success', 'Mentor berhasil dihapus!');
    }

    /**
     * Toggle active status
     */
    public function toggleActive(Mentor $mentor)
    {
        $mentor->is_active = !$mentor->is_active;
        $mentor->save();

        return redirect()
            ->route('admin.mentors')
            ->with('success', 'Status mentor berhasil diperbarui!');
    }
}
