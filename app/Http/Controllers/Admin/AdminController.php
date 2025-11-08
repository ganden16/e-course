<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\Admin\AdminRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('username', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $admins = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admins.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        $data = $request->validated();

        // Handle password
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();

            // Store image in public/storage/admins directory
            $image->move(public_path('storage/admins'), $imageName);

            // Save full URL to database
            $data['image'] = url('storage/admins/' . $imageName);
        }

        User::create($data);

        return redirect()->route('admin.admins')
            ->with('success', 'Admin berhasil ditambahkan!');
    }

    /**
     * Show the form for viewing/editing the specified resource.
     */
    public function edit(User $admin)
    {
        if($admin->id == auth()->user()->id) {
            return redirect()->route('admin.profile');
        }
        return view('admin.admins.form', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, User $admin)
    {
        $data = $request->validated();

        // Handle password
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($admin->image) {
                $imagePath = public_path('storage/admins/' . basename($admin->image));
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();

            // Store image in public/storage/admins directory
            $image->move(public_path('storage/admins'), $imageName);

            // Save full URL to database
            $data['image'] = url('storage/admins/' . $imageName);
        }

        $admin->update($data);

        return redirect()->route('admin.admins')
            ->with('success', 'Admin berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $admin)
    {
        // Delete image if exists
        if ($admin->image) {
            $imagePath = public_path('storage/admins/' . basename($admin->image));
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $admin->delete();

        return redirect()->route('admin.admins')
            ->with('success', 'Admin berhasil dihapus!');
    }
}
