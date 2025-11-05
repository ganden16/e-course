<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Http\Requests\Admin\AdminRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Display login page
     */
    public function showLoginForm()
    {
        // If user is already logged in, redirect to admin dashboard
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required',
        ]);

        // Use only username for authentication
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password], $request->filled('remember-me'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->withInput($request->except('password'));
    }

    /**
     * Show profile edit page for current admin.
     */
    public function profile()
    {
        $admin = auth()->user();
        return view('admin.profile', compact('admin'));
    }

    /**
     * Update profile of current admin.
     */
    public function updateProfile(AdminRequest $request)
    {
        $admin = auth()->user();
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
                $oldImagePath = public_path('storage/admins/' . basename($admin->image));
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
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

        return redirect()->route('admin.profile')
            ->with('success', 'Profile berhasil diperbarui!');
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
