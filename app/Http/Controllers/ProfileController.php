<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    private function foo($user, $data) {
        $user->update($data);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($user->image && Storage::exists('public/profile/' . $user->image)) {
                Storage::delete('public/profile/' . $user->image);
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/profile', $imageName);
            $data['image'] = $imageName;
        }

       $this->foo($user, $data);


        return redirect()->route('crud.index')->with('success', 'Profil berhasil diperbarui!');
    }
}
