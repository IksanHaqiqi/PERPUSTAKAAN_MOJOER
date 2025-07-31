<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Lemari;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $layout = 'layout.landing';

        if (auth()->check()) {
            if (auth()->user()->role === 'admin') {
                $layout = 'layout.admin';
            } elseif (auth()->user()->role === 'user') {
                $layout = 'layout.peminjaman';
            }
        }


        // Jika ada lemari_id di request, simpan untuk keperluan add button
        $lemari = null;
        if ($request->has('lemari_id')) {
            $lemari = Lemari::find($request->lemari_id);
        }

        $query = Peminjaman::with('lemari');

        // Filter berdasarkan user role
        if (Auth::user()->role !== 'admin') {
            $query->where('user_id', Auth::id());
        }

        // Filter pencarian judul buku
        if ($request->filled('search')) {
            $query->whereHas('lemari', function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%');
            });
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter tanggal dari
        if ($request->filled('date_from')) {
            $query->whereDate('tanggal_pinjam', '>=', $request->date_from);
        }

        // Filter tanggal sampai
        if ($request->filled('date_to')) {
            $query->whereDate('tanggal_pinjam', '<=', $request->date_to);
        }

        // Set default per page
        $perPage = $request->get('per_page', 10);

        // Validasi per page value
        if (!in_array($perPage, [10, 25, 50, 100])) {
            $perPage = 10;
        }

        // Order by tanggal pinjam terbaru
        $query->orderBy('tanggal_pinjam', 'desc');

        // Pagination
        $peminjamans = $query->paginate($perPage);

        return view('peminjaman.index', compact('peminjamans', 'lemari', 'layout'));
    }

    public function create($id)
    {
        $lemari = Lemari::findOrFail($id);
        $lemaris = Lemari::all();
        $peminjamans = Peminjaman::with('lemari')->where('lemari_id', $id)->get();

        return view('peminjaman.create', compact('lemari', 'lemaris', 'peminjamans'));
    }

    // PeminjamanController.php
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'lemari_id' => 'required|exists:lemaris,id',
        ]);

        $lemari = Lemari::findOrFail($request->lemari_id);

        // Cek stok tersedia
        if ($lemari->stock <= 0) {
            return back()->with('error', 'Stok buku habis.');
        }

        // Kurangi stok
        $lemari->decrement('stock');

        // Simpan data peminjaman
        Peminjaman::create([
            'user_id' => auth()->id(),
            'lemari_id' => $request->lemari_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'menunggu',
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Permintaan peminjaman dikirim ');
    }


    public function destroy($id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        if (auth()->user()->role === 'user' && $pinjam->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $pinjam->delete();
        return redirect()->back()->with('success', 'Data peminjaman berhasil dihapus.');
    }


    public function adminIndex(Request $request)
    {
        $layout = 'layout.admin';

    // Start building the query with relationships
    $query = Peminjaman::with(['user', 'lemari']);

    // Filter pencarian judul buku
    if ($request->filled('search')) {
        $searchTerm = trim($request->search);
        $query->whereHas('lemari', function ($q) use ($searchTerm) {
            $q->where('judul', 'like', '%' . $searchTerm . '%');
        });
    }

    // Filter berdasarkan nama peminjam (khusus admin)
    if ($request->filled('user_search')) {
        $userSearchTerm = trim($request->user_search);
        $query->whereHas('user', function ($q) use ($userSearchTerm) {
            $q->where('name', 'like', '%' . $userSearchTerm . '%');
        });
    }

    // Filter status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Filter tanggal dari
    if ($request->filled('date_from')) {
        $query->whereDate('tanggal_pinjam', '>=', $request->date_from);
    }

    // Filter tanggal sampai
    if ($request->filled('date_to')) {
        $query->whereDate('tanggal_pinjam', '<=', $request->date_to);
    }

    // Validasi dan set per page
    $perPage = $request->get('per_page', 10);
    $allowedPerPage = [10, 25, 50, 100];
    
    if (!in_array((int)$perPage, $allowedPerPage)) {
        $perPage = 10;
    }

    // Order by tanggal pinjam terbaru
    $query->orderBy('tanggal_pinjam', 'desc')
          ->orderBy('id', 'desc');

    // Execute pagination
    $peminjamans = $query->paginate((int)$perPage);
    
    // Preserve query parameters in pagination links
    $peminjamans->appends($request->query());

    return view('peminjaman.index', compact('peminjamans', 'layout'));
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::with(['lemari', 'user'])->findOrFail($id);

        // Cek akses
        if (!Auth::user()->role !== 'admin' && $peminjaman->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk melihat data ini.');
        }

        return view('peminjaman.show', compact('peminjaman'));
    }

    public function edit($id)
    {
        $peminjaman = Peminjaman::with('lemari')->findOrFail($id);

        // Cek akses - hanya user yang meminjam dan belum dikembalikan yang bisa edit
        if ($peminjaman->user_id !== Auth::id() || $peminjaman->tanggal_kembali) {
            return redirect()->back()->with('error', 'Anda tidak dapat mengedit data ini.');
        }

        return view('peminjaman.edit', compact('peminjaman'));
    }

    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // Cek akses
        if ($peminjaman->user_id !== Auth::id() || $peminjaman->tanggal_kembali) {
            return redirect()->back()->with('error', 'Anda tidak dapat mengedit data ini.');
        }

        $request->validate([
            'tanggal_pinjam' => 'required|date',
        ]);

        $peminjaman->update([
            'tanggal_pinjam' => $request->tanggal_pinjam,
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diupdate.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,disetujui,ditolak',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = $request->status;
        $peminjaman->save();

        return redirect()->route('peminjaman.status')->with('success', 'Status peminjaman berhasil diperbarui.');
    }

    // Method untuk export data (opsional)
    public function export(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk export data.');
        }

        // Implementasi export sesuai kebutuhan (Excel, PDF, etc.)
        // Bisa menggunakan package seperti Laravel Excel atau TCPDF

        return redirect()->back()->with('info', 'Fitur export akan segera tersedia.');
    }


public function cetakPDF()
{
    try {
        // Ambil data dengan relasi
        $peminjamans = Peminjaman::with(['user', 'lemari'])->get();
        
        // Cek apakah ada data
        if ($peminjamans->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data peminjaman untuk dicetak');
        }

        // Load view dengan data
        $pdf = Pdf::loadView('peminjaman.pdf', compact('peminjamans'))
            ->setPaper('A4', 'landscape')  // Format landscape untuk tabel lebar
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => true,
                'defaultFont' => 'sans-serif'
            ]);

        // Download PDF dengan nama file yang jelas
        $filename = 'data_peminjaman_' . date('Y-m-d_H-i-s') . '.pdf';
        
        return $pdf->download($filename);
        
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Gagal membuat PDF: ' . $e->getMessage());
    }
}

// Alternatif method untuk stream (buka di browser)
public function streamPDF()
{
    try {
        $peminjamans = Peminjaman::with(['user', 'lemari'])->get();
        
        $pdf = Pdf::loadView('peminjaman.pdf', compact('peminjamans'))
            ->setPaper('A4', 'landscape');

        return $pdf->stream('data_peminjaman.pdf');
        
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Gagal membuat PDF: ' . $e->getMessage());
    }
}
}
