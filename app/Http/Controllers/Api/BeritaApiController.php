<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class BeritaApiController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Berita::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:beritas,slug',
            'penulis' => 'required|string|max:255',
            'tanggal_publish' => 'required|date',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('images', 'public');
        }

        $berita = Berita::create($validated);

        return response()->json([
            'status' => 'success',
            'data' => $berita,
        ]);
    }

    public function show($id)
    {
        $berita = Berita::find($id);

        if (! $berita) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(['data' => $berita]);
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:beritas,slug,' . $id,
            'penulis' => 'required|string|max:255',
            'tanggal_publish' => 'required|date',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('images', 'public');
        }

        $berita->update($validated);

        return response()->json(['message' => 'Updated', 'data' => $berita]);
    }

    public function destroy($id)
    {
        $berita = Berita::find($id);
        if (! $berita) {
            return response()->json(['message' => 'Not found'], 404);
        }

        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return response()->json(['message' => 'Deleted']);
    }
}