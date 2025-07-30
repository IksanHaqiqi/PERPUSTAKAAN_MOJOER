<!DOCTYPE html>
<html>
<head>
    <title>Data Peminjaman Buku</title>
    <meta charset="utf-8">
    <style>
        body { 
            font-family: 'DejaVu Sans', sans-serif; 
            margin: 20px;
            font-size: 12px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }
        
        .header h1 {
            margin: 0;
            font-size: 18px;
            color: #333;
        }
        
        .header p {
            margin: 5px 0;
            font-size: 12px;
            color: #666;
        }
        
        .info-table {
            width: 100%;
            margin-bottom: 20px;
        }
        
        .info-table td {
            border: none;
            padding: 2px 0;
            font-size: 11px;
        }
        
        table { 
            width: 100%; 
            border-collapse: collapse; 
            font-size: 10px;
            margin-top: 10px;
        }
        
        th, td { 
            border: 1px solid #333; 
            padding: 6px 4px; 
            text-align: center; 
            vertical-align: middle;
        }
        
        th {
            background-color: #f0f0f0;
            font-weight: bold;
            font-size: 10px;
            text-transform: uppercase;
        }
        
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .status-dipinjam {
            color: #856404;
            font-weight: bold;
        }
        
        .status-dikembalikan {
            color: #155724;
            font-weight: bold;
        }
        
        .status-terlambat {
            color: #721c24;
            font-weight: bold;
        }
        
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
        }
        
        .signature {
            margin-top: 50px;
            text-align: right;
        }
        
        .signature-box {
            display: inline-block;
            text-align: center;
            margin-left: 200px;
        }
        
        .signature-line {
            width: 200px;
            border-top: 1px solid #333;
            margin-top: 60px;
        }

        /* Untuk kolom yang lebih lebar */
        .col-no { width: 5%; }
        .col-nama { width: 20%; }
        .col-judul { width: 25%; }
        .col-tgl-pinjam { width: 15%; }
        .col-tgl-kembali { width: 15%; }
        .col-status { width: 15%; }
    </style>
</head>
<body>
    <div class="header">
        <h1>📚 LAPORAN DATA PEMINJAMAN BUKU</h1>
        <p>Perpustakaan Digital</p>
    </div>

    <table class="info-table">
        <tr>
            <td style="width: 15%;">Tanggal Cetak</td>
            <td style="width: 2%;">:</td>
            <td>{{ date('d F Y, H:i') }} WIB</td>
            <td style="width: 15%; text-align: right;">Total Data</td>
            <td style="width: 2%;">:</td>
            <td style="width: 10%;">{{ count($peminjamans) }} record</td>
        </tr>
    </table>
    
    <table>
        <thead>
            <tr>
                <th class="col-no">No</th>
                <th class="col-nama">Nama Peminjam</th>
                <th class="col-judul">Judul Buku</th>
                <th class="col-tgl-pinjam">Tanggal Pinjam</th>
                <th class="col-tgl-kembali">Tanggal Kembali</th>
                <th class="col-status">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peminjamans as $key => $pinjam)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td style="text-align: left;">{{ $pinjam->user->name ?? 'Tidak Diketahui' }}</td>
                <td style="text-align: left;">{{ $pinjam->lemari->judul ?? 'Tidak Diketahui' }}</td>
                <td>{{ $pinjam->tanggal_pinjam ? \Carbon\Carbon::parse($pinjam->tanggal_pinjam)->format('d-m-Y') : '-' }}</td>
                <td>{{ $pinjam->tanggal_kembali ? \Carbon\Carbon::parse($pinjam->tanggal_kembali)->format('d-m-Y') : '-' }}</td>
                <td>
                    <span class="status-{{ strtolower($pinjam->status) }}">
                        {{ ucfirst($pinjam->status) }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; font-style: italic; color: #666;">
                    Tidak ada data peminjaman
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p><strong>Ringkasan:</strong></p>
        <p>• Total Peminjaman: {{ count($peminjamans) }}</p>
        <p>• Sedang Dipinjam: {{ $peminjamans->where('status', 'dipinjam')->count() }}</p>
        <p>• Sudah Dikembalikan: {{ $peminjamans->where('status', 'dikembalikan')->count() }}</p>
        <p>• Terlambat: {{ $peminjamans->where('status', 'terlambat')->count() }}</p>
    </div>

    <div class="signature">
        <div class="signature-box">
            <p>{{ date('d F Y') }}</p>
            <p>Petugas Perpustakaan</p>
            <div class="signature-line"></div>
            <p>(.............................)</p>
        </div>
    </div>
</body>
</html>