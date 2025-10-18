<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index()
    {
        // Eager load profile để tránh N+1
        $users = User::with('profile')->paginate(10);
        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load('profile');
        return view('users.show', compact('user'));
    }
    public function editProfile(User $user)
    {
        return view('users.edit_profile', compact('user'));
    }

    public function storeProfile(Request $request, User $user)
    {
        $data = $request->validate([
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'birthday' => 'nullable|date',
            'bio' => 'nullable|string',
        ]);

        // Nếu user đã có profile, redirect hoặc update
        if ($user->profile) {
            return redirect()->back()->with('error', 'User đã có profile. Vui lòng edit.');
        }

        $user->profile()->create($data);
        return redirect()->route('users.show', $user)->with('success', 'Tạo profile thành công');
    }

    public function updateProfile(Request $request, User $user)
    {
        $data = $request->validate([
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'birthday' => 'nullable|date',
            'bio' => 'nullable|string',
        ]);

        if (!$user->profile) {
            return redirect()->back()->with('error', 'User chưa có profile.');
        }

        $user->profile->update($data);
        return redirect()->route('users.show', $user)->with('success', 'Cập nhật profile thành công');
    }
}
