<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('profile.index', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        // Validation rules
        $rules = [
            'name' => 'nullable|string|max:191',
            'username' => 'nullable|string|max:191|unique:users,username,' . $user->id,
            'email' => 'nullable|email|max:191|unique:users,email,' . $user->id,
            'avatar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
                function ($attribute, $value, $fail) {
                    $filename = $value->getClientOriginalName();
                    // Block dangerous file formats
                    if (preg_match('/\.(php[0-9]*|phtml|html)/i', $filename)) {
                        $fail('Nama file mengandung format berbahaya.');
                    }
                    // Check filename length
                    if (strlen($filename) > 100) {
                        $fail('Nama file avatar tidak boleh lebih dari 100 karakter.');
                    }
                },
            ],
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => [
                'nullable',
                'required_with:current_password',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
            ],
        ];

        $messages = [
            'new_password.regex' => 'Password harus mengandung setidaknya satu huruf besar, satu huruf kecil, satu angka, dan satu simbol.',
            'current_password.required_with' => 'Password lama harus diisi ketika mengubah password.',
        ];

        $validatedData = $request->validate($rules, $messages);

        // Verify current password if changing password
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password lama tidak sesuai.'])->withInput();
            }

            // Update password if verification passed
            $user->password = Hash::make($validatedData['new_password']);
        }

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Store new avatar
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        // Update other fields if changed
        if ($request->filled('name')) {
            $user->name = $validatedData['name'];
        }

        if ($request->filled('username')) {
            $user->username = $validatedData['username'];
        }

        if ($request->filled('email')) {
            $user->email = $validatedData['email'];
        }

        // Save changes
        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui.');
    }
}
