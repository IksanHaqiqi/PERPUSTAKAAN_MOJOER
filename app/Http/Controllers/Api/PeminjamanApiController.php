<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Lemari;
use Illuminate\Support\Facades\Auth;

class PeminjamanApiController extends Controller
{
    // Ambil semua peminjaman (dibatasi role)
    public function index()
    {
        $user = Auth::user();

        $query = Peminjaman::with(['lemari', 'user']);

        if ($user->role !== 'admin') {
            $query->where('user_id', $user->id);
        }

        return response()->json([
            'status' => 'success',
            'data' => $query->get()
        ]);
    }

    // Tambah peminjaman
    public function store(Request $request)
    {
        $request->validate([
            'lemari_id' => 'required|exists:lemaris,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $lemari = Lemari::find($request->lemari_id);

        if ($lemari->stock <= 0) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Stok buku habis'
            ], 400);
        }

        $lemari->decrement('stock');

        $peminjaman = Peminjaman::create([
            'user_id' => Auth::id(),
            'lemari_id' => $request->lemari_id,
            'peminjam' => Auth::user()->name, 
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'menunggu',
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $peminjaman
        ]);
    }

    // Tampilkan detail 1 peminjaman
    public function show($id)
    {
        $peminjaman = Peminjaman::with(['lemari', 'user'])->findOrFail($id);

        if (Auth::user()->role !== 'admin' && $peminjaman->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json([
            'status' => 'success',
            'data' => $peminjaman
        ]);
    }

    // Update tanggal pinjam (hanya user pemilik)
    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'tanggal_pinjam' => 'required|date',
        ]);

        $peminjaman->update([
            'tanggal_pinjam' => $request->tanggal_pinjam,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $peminjaman
        ]);
    }

    // Hapus peminjaman
    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if (Auth::user()->role !== 'admin' && $peminjaman->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $peminjaman->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Peminjaman berhasil dihapus'
        ]);
    }
}
