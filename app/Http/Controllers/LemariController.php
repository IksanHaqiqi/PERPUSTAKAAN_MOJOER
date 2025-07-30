<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lemari;
use Illuminate\Support\Facades\Storage;
use function view;

class LemariController extends Controller
{
    public function index()
    {

        $layout = 'layout.landing';

        if (auth()->check()) {
            if (auth()->user()->role === 'admin') {
                $layout = 'layout.admin';
            } elseif (auth()->user()->role === 'user') {
                $layout = 'layout.user';
            }
        }
        $lemaris = Lemari::all();
        return view('crud.index', compact('lemaris','layout'));
    }

    public function create()
    {
        return view('crud.create');
    }

    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Simpan gambar jika ada
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        Lemari::create($validated);

        return redirect()->route('crud.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $lemari = Lemari::findOrFail($id);
        return view('crud.edit', compact('lemari'));
    }

    public function update(Request $request, $id)
    {
        $lemari = Lemari::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Hapus gambar lama jika upload baru
        if ($request->hasFile('image')) {
            if ($lemari->image) {
                Storage::disk('public')->delete($lemari->image);
            }
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        $lemari->update($validated);

        return redirect()->route('crud.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $lemari = Lemari::findOrFail($id);

        // Hapus gambar juga jika ada
        if ($lemari->image) {
            Storage::disk('public')->delete($lemari->image);
        }

        $lemari->delete();

        return redirect()->route('crud.index')->with('success', 'Data berhasil dihapus');
    }
}
