<?php

namespace App\Http\Controllers;

use App\Models\Lemari;
use App\Models\Peminjaman;
use Carbon\Carbon;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function index()
    {
        // Update status terlambat dulu
        $this->updateOverdueStatus();

        // Kumpulkan semua data yang dibutuhkan
        $data = [
            'stats' => $this->getStats(),
            'categoryData' => $this->getCategoryData(),
            'statusData' => $this->getStatusData(),
            'trendData' => $this->getTrendData(),
            'stockData' => $this->getStockData(),
            'booksData' => $this->getBooksData(),
            'recentBorrows' => $this->getRecentBorrows()
        ];

        return view('chart.index', compact('data'));
    }

    private function updateOverdueStatus()
    {
        Peminjaman::where('status', 'dipinjam')
            ->where('tanggal_kembali', '<', Carbon::now())
            ->update(['status' => 'terlambat']);
    }

    private function getStats()
    {
        return [
            'total_books' => Lemari::sum('stock'),
            'active_borrows' => Peminjaman::where('status', 'menunggu')->count(),
            'returned_books' => Peminjaman::where('status', 'disetujui')->count(),
            'overdue_books' => Peminjaman::where('status', 'ditolak')->count()
        ];
    }

    private function getCategoryData()
    {
        return Lemari::select('kategori', DB::raw('SUM(stock) as total'))
            ->groupBy('kategori')
            ->get()
            ->map(function ($item) {
                return [
                    'kategori' => $item->kategori,
                    'total' => (int) $item->total
                ];
            });
    }

    private function getStatusData()
    {
        return Peminjaman::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->get()
            ->map(function ($item) {
                return [
                    'status' => ucfirst($item->status),
                    'total' => (int) $item->total
                ];
            });
    }

    private function getTrendData()
    {
        $trends = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $month = $date->format('M');

            $borrows = Peminjaman::whereMonth('tanggal_pinjam', $date->month)
                ->whereYear('tanggal_pinjam', $date->year)
                ->count();

            $returns = Peminjaman::whereMonth('updated_at', $date->month)
                ->whereYear('updated_at', $date->year)
                ->where('status', 'dikembalikan')
                ->count();

            $trends[] = [
                'month' => $month,
                'borrows' => $borrows,
                'returns' => $returns
            ];
        }

        return $trends;
    }

    private function getStockData()
    {
        $totalStock = Lemari::sum('stock');
        $borrowedStock = Peminjaman::where('status', 'dipinjam')->count();
        $availableStock = $totalStock - $borrowedStock;

        return [
            'available' => $availableStock,
            'borrowed' => $borrowedStock
        ];
    }

    private function getBooksData()
    {
        return Lemari::select('judul', 'penerbit', 'kategori', 'stock')
            ->orderBy('judul')
            ->get();
    }

    private function getRecentBorrows()
    {
        return Peminjaman::with(['lemari:id,judul', 'user:id,name'])
            ->select('id', 'lemari_id', 'user_id', 'tanggal_pinjam', 'status')
            ->orderBy('tanggal_pinjam', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($item) {
                return [
                    'peminjam' => $item->user->name ?? 'Unknown',
                    'tanggal_pinjam' => \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d/m/Y'),

                    'status' => ucfirst($item->status),
                    'judul_buku' => $item->lemari->judul ?? 'Unknown'
                ];
            });
    }
}
