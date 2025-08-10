<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
  public function index(Request $request)
{
    $layout = 'layout.landing';

    if (auth()->check()) {
        if (auth()->user()->role === 'admin') {
            $layout = 'layout.admin';
        } elseif (auth()->user()->role === 'user') {
            $layout = 'layout.berita';
        }
    }

   $beritas = Berita::latest('tanggal_publish')->get();
    $recentPosts = Berita::latest('tanggal_publish')->take(5)->get();

    $highlightBerita = null;
    if ($request->has('highlight')) {
        $highlightBerita = Berita::find($request->highlight);
    }

    return view('berita.index', compact('layout', 'beritas', 'recentPosts', 'highlightBerita'));
}

    public function adminIndex()
    {
        $layout = 'layout.admin';
        $beritas = Berita::all();

        return view('berita.status', compact('beritas', 'layout'));
    }


    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        $layout = 'layout.admin';

        return view('berita.edit', compact('berita', 'layout'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:beritas,slug,' . $id,
            'penulis' => 'required|string|max:255',
            'tanggal_publish' => 'required|date',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $berita = Berita::findOrFail($id);
        $berita->judul = $request->judul;
        $berita->slug = $request->slug;
        $berita->penulis = $request->penulis;
        $berita->tanggal_publish = $request->tanggal_publish;
        $berita->isi = $request->isi;

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($berita->gambar && Storage::exists('public/images/' . $berita->gambar)) {
                Storage::delete('public/images/' . $berita->gambar);
            }

            $gambarBaru = $request->file('gambar')->store('images', 'public');
            $berita->gambar = str_replace('images/', '', $gambarBaru);
        }

        $berita->save();

        return redirect()->route('berita.status')->with('success', 'Berita berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        // Hapus gambar jika ada
        if ($berita->gambar && Storage::exists('public/images/' . $berita->gambar)) {
            Storage::delete('public/images/' . $berita->gambar);
        }

        $berita->delete();

        return redirect()->route('berita.status')->with('success', 'Berita berhasil dihapus.');
    }



}
