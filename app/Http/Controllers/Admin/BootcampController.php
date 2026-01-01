<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bootcamp;
use App\Models\Mentor;
use App\Models\Category;
use App\Models\ModuleBootcamp;
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
    public function index(Request $request)
    {
        $query = Bootcamp::with(['mentors', 'category']);

        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('is_active', $request->status === 'active');
        }

        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('level', 'like', '%' . $request->search . '%')
                  ->orWhere('schedule', 'like', '%' . $request->search . '%');
            });
        }

        $bootcamps = $query->orderBy('created_at', 'desc')->paginate(10);
        $categories = Category::where('is_active', true)->orderBy('updated_at', 'desc')->get();

        return view('admin.bootcamps.index', compact('bootcamps', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mentors = Mentor::where('is_active', true)->get();
        $categories = Category::where('is_active', true)->orderBy('updated_at', 'desc')->get();

        return view('admin.bootcamps.form', compact('mentors', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BootcampRequest $request)
    {
        $data = $request->validated();

        if(isset($data['is_active'])) {
            $data['is_active'] = true;
        }else{
            $data['is_active'] = false;
        }

        // Handle array fields
        // $arrayFields = ['features', 'curriculum', 'learning_outcomes', 'career_support', 'requirements'];
        $arrayFields = ['learning_outcomes', 'career_support', 'requirements'];
        foreach ($arrayFields as $field) {
            if (isset($data[$field])) {
                if (is_array($data[$field])) {
                    // Filter out empty values and trim each element
                    $data[$field] = array_filter($data[$field], function($value) {
                        return !is_null($value) && $value !== '';
                    });
                    // Trim each element
                    $data[$field] = array_map('trim', $data[$field]);
                    // Re-index array
                    $data[$field] = array_values($data[$field]);
                } elseif (is_string($data[$field])) {
                    // Fallback for textarea input (backward compatibility)
                    $data[$field] = array_filter(explode("\n", $data[$field]));
                    // Trim each element and remove empty values
                    $data[$field] = array_map('trim', $data[$field]);
                    $data[$field] = array_filter($data[$field]);
                    // Re-index array
                    $data[$field] = array_values($data[$field]);
                }
            }
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('bootcamps', $imageName, 'public');
            $data['image'] = url('storage/bootcamps/' . $imageName);
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


        // Handle modules
        if (isset($data['modules'])) {
            // Delete existing modules
            $bootcamp->modules()->delete();

            // Create new modules
            foreach ($data['modules'] as $key => $moduleData) {
                if (!empty($moduleData['module'])) { // Only save if module name is not empty
                    $moduleData['bootcamp_id'] = $bootcamp->id;
                    $moduleData['week_number'] = $key + 1;

                    // Handle topics field
                    // if (isset($moduleData['topics']) && is_string($moduleData['topics'])) {
                    //     $moduleData['topics'] = array_filter(explode("\n", $moduleData['topics']));
                    //     $moduleData['topics'] = array_map('trim', $moduleData['topics']);
                    //     $moduleData['topics'] = array_filter($moduleData['topics']);
                    //     $moduleData['topics'] = array_values($moduleData['topics']);
                    // }

                    ModuleBootcamp::create($moduleData);
                }
            }
        }

        return redirect()
            ->back()
            ->with('success', 'Bootcamp berhasil dibuat!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bootcamp $bootcamp)
    {
        $bootcamp->load(['mentors', 'category']);
        $mentors = Mentor::where('is_active', true)->get();
        $categories = Category::where('is_active', true)->orderBy('updated_at', 'desc')->get();

        return view('admin.bootcamps.form', compact('bootcamp', 'mentors', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BootcampRequest $request, Bootcamp $bootcamp)
    {
        $data = $request->validated();

        if(isset($data['is_active'])) {
            $data['is_active'] = true;
        }else{
            $data['is_active'] = false;
        }

        // Handle array fields
        // $arrayFields = ['features', 'curriculum', 'learning_outcomes', 'career_support', 'requirements'];
        $arrayFields = ['learning_outcomes', 'career_support', 'requirements'];
        foreach ($arrayFields as $field) {
            if (isset($data[$field])) {
                if (is_array($data[$field])) {
                    // Filter out empty values and trim each element
                    $data[$field] = array_filter($data[$field], function($value) {
                        return !is_null($value) && $value !== '';
                    });
                    // Trim each element
                    $data[$field] = array_map('trim', $data[$field]);
                    // Re-index array
                    $data[$field] = array_values($data[$field]);
                } elseif (is_string($data[$field])) {
                    // Fallback for textarea input (backward compatibility)
                    $data[$field] = array_filter(explode("\n", $data[$field]));
                    // Trim each element and remove empty values
                    $data[$field] = array_map('trim', $data[$field]);
                    $data[$field] = array_filter($data[$field]);
                    // Re-index array
                    $data[$field] = array_values($data[$field]);
                }
            }
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($bootcamp->image) {
                // Extract filename from full URL if it's a full URL
                $imagePath = $bootcamp->image;
                if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
                    $imagePath = basename(parse_url($imagePath, PHP_URL_PATH));
                }
                Storage::disk('public')->delete('bootcamps/' . $imagePath);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('bootcamps', $imageName, 'public');
            $data['image'] = url('storage/bootcamps/' . $imageName);
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


        // Handle modules
        if (isset($data['modules'])) {
            // Delete existing modules
            $bootcamp->modules()->delete();

            // Create new modules
            foreach ($data['modules'] as $key => $moduleData) {
                if (!empty($moduleData['module'])) { // Only save if module name is not empty
                    $moduleData['bootcamp_id'] = $bootcamp->id;
                    $moduleData['week_number'] = $key + 1;

                    // Handle topics field
                    // if (isset($moduleData['topics']) && is_string($moduleData['topics'])) {
                    //     $moduleData['topics'] = array_filter(explode("\n", $moduleData['topics']));
                    //     $moduleData['topics'] = array_map('trim', $moduleData['topics']);
                    //     $moduleData['topics'] = array_filter($moduleData['topics']);
                    //     $moduleData['topics'] = array_values($moduleData['topics']);
                    // }

                    ModuleBootcamp::create($moduleData);
                }
            }
        }

        return redirect()
            ->back()
            ->with('success', 'Bootcamp berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bootcamp $bootcamp)
    {
        // Delete image
        if ($bootcamp->image) {
            // Extract filename from full URL if it's a full URL
            $imagePath = $bootcamp->image;
            if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
                $imagePath = basename(parse_url($imagePath, PHP_URL_PATH));
            }
            Storage::disk('public')->delete('bootcamps/' . $imagePath);
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
