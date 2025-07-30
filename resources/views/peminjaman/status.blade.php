@extends($layout)

@section('content')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Data Peminjaman Buku</h6>
                        @isset($lemari)
                            <a href="{{ route('peminjaman.create', ['lemari_id' => $lemari->id]) }}"
                                class="btn btn-warning btn-sm">
                                <i class="fas fa-plus me-1"></i> Tambah Peminjaman
                            </a>
                        @endisset
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        @if (session('success'))
                            <div class="alert alert-success mx-3 mt-3">{{ session('success') }}</div>
                        @endif
                        <div class="table-responsive p-3">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Peminjam</th>
                                        <th>Judul Buku</th>
                                        <th>Gambar</th>
                                        <th class="text-center">Tanggal Pinjam</th>
                                        <th class="text-center">Tanggal Kembali</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($peminjamans as $pinjam)
                                        <tr>
                                            <td class="ps-4">{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="me-2">
                                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($pinjam->user->name) }}"
                                                            class="avatar avatar-sm rounded-circle" alt="avatar">
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-0 text-sm">{{ $pinjam->user->name }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $pinjam->lemari->judul }}</td>
                                            <td>
                                                @if ($pinjam->lemari->image)
                                                    <img src="{{ asset('storage/' . $pinjam->lemari->image) }}"
                                                        alt="Gambar Buku" width="60" class="rounded">
                                                @else
                                                    <span class="badge bg-secondary">No Image</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($pinjam->tanggal_pinjam)->format('d M Y') }}
                                            </td>
                                            <td class="text-center">
                                                    {{ \Carbon\Carbon::parse($pinjam->tanggal_kembali)->format('d M Y') }}
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-{{ $pinjam->status === 'disetujui' ? 'success' : ($pinjam->status === 'ditolak' ? 'danger' : 'primary') }}">
                                                    {{ ucfirst($pinjam->status) }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                @if (Auth::user()->isAdmin())
                                                    <form action="{{ route('peminjaman.updateStatus', $pinjam->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        <select name="status" class="form-select form-select-sm"
                                                            onchange="this.form.submit()">
                                                            <option value="menunggu"
                                                                {{ $pinjam->status === 'menunggu' ? 'selected' : '' }}>
                                                                Menunggu</option>
                                                            <option value="disetujui"
                                                                {{ $pinjam->status === 'disetujui' ? 'selected' : '' }}>
                                                                Disetujui</option>
                                                            <option value="ditolak"
                                                                {{ $pinjam->status === 'ditolak' ? 'selected' : '' }}>
                                                                Ditolak</option>
                                                        </select>
                                                    </form>
                                                    <form action="{{ route('peminjaman.destroy', $pinjam->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')"
                                                        class="d-inline ms-2">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-link text-danger text-xs mb-0">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    @if (!$pinjam->tanggal_kembali && $pinjam->status === 'menunggu')
                                                        <form action="{{ route('peminjaman.destroy', $pinjam->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Yakin ingin membatalkan peminjaman ini?')"
                                                            style="display:inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-link text-danger text-xs mb-0">
                                                                <i class="fas fa-times"></i> Batal
                                                            </button>
                                                        </form>
                                                    @else
                                                        <span class="text-secondary text-xs">-</span>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-xs text-secondary py-4">
                                                <i class="fas fa-book-open me-1"></i> Belum ada data peminjaman
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection