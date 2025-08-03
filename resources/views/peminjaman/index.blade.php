@extends($layout)

@section('content')

    <!-- Main Content -->


    <div class="page-content-wrapper">
        <div class="main-content">
            <div class="container-fluid container x-1 py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                                <h6 class="text-dark">Data Peminjaman Buku</h6>
                                <div class="d-flex gap-2">
                                    @isset($lemari)
                                        <a href="{{ route('peminjaman.create', ['lemari_id' => $lemari->id]) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="fas fa-plus me-1"></i> Tambah Peminjaman
                                        </a>
                                    @endisset
                                    <a href="{{ route('peminjaman.pdf') }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-file-pdf me-1"></i> Cetak PDF
                                    </a>
                                </div>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2">
                                @if (session('success'))
                                    <div class="alert alert-success mx-3 mt-3">{{ session('success') }}</div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger mx-3 mt-3">{{ session('error') }}</div>
                                @endif

                                <!-- Filter Section -->
                                <div class="px-3 mb-3">
                                    <form method="GET" action="{{ request()->url() }}" class="row g-2">
                                        <!-- Search by Book Title -->
                                        <div class="col-md-3">
                                            <label for="search" class="form-label text-sm">Cari Judul Buku</label>
                                            <input type="text" class="form-control form-control-sm" id="search"
                                                name="search" value="{{ request('search') }}"
                                                placeholder="Masukkan judul buku...">
                                        </div>

                                        <!-- Status Filter -->
                                        <div class="col-md-2">
                                            <label for="status" class="form-label text-sm">Status</label>
                                            <select class="form-select form-select-sm" id="status" name="status">
                                                <option value="">Semua Status</option>
                                                <option value="menunggu"
                                                    {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu
                                                </option>
                                                <option value="disetujui"
                                                    {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui
                                                </option>
                                                <option value="ditolak"
                                                    {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                            </select>
                                        </div>

                                        <!-- Date From -->
                                        <div class="col-md-2">
                                            <label for="date_from" class="form-label text-sm">Dari Tanggal</label>
                                            <input type="date" class="form-control form-control-sm" id="date_from"
                                                name="date_from" value="{{ request('date_from') }}">
                                        </div>

                                        <!-- Date To -->
                                        <div class="col-md-2">
                                            <label for="date_to" class="form-label text-sm">Sampai Tanggal</label>
                                            <input type="date" class="form-control form-control-sm" id="date_to"
                                                name="date_to" value="{{ request('date_to') }}">
                                        </div>

                                        <!-- Per Page -->
                                        <div class="col-md-2">
                                            <label for="per_page" class="form-label text-sm">Per Halaman</label>
                                            <select class="form-select form-select-sm" id="per_page" name="per_page">
                                                <option value="10" {{ request('per_page') == '10' ? 'selected' : '' }}>
                                                    10</option>
                                                <option value="25" {{ request('per_page') == '25' ? 'selected' : '' }}>
                                                    25</option>
                                                <option value="50" {{ request('per_page') == '50' ? 'selected' : '' }}>
                                                    50</option>
                                                <option value="100"
                                                    {{ request('per_page') == '100' ? 'selected' : '' }}>100</option>
                                            </select>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="col-md-1">
                                            <label class="form-label text-sm">&nbsp;</label>
                                            <div class="d-flex gap-1">
                                                <button type="submit" class="btn btn-primary btn-sm p-1" title="Filter"
                                                    style="height: 24px; width: 24px;">
                                                    <i class="fas fa-search" style="font-size: 10px;"></i>
                                                </button>
                                                <a href="{{ request()->url() }}" class="btn btn-secondary btn-sm p-1"
                                                    title="Reset" style="height: 24px; width: 24px;">
                                                    <i class="fas fa-redo" style="font-size: 10px;"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </form>
                                </div>

                                <!-- Table Info and Statistics -->
                                <div class="px-3 mb-2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <small class="text-muted">
                                                Menampilkan {{ $peminjamans->firstItem() ?? 0 }} -
                                                {{ $peminjamans->lastItem() ?? 0 }} dari {{ $peminjamans->total() }} data
                                            </small>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            @if (request()->hasAny(['search', 'status', 'date_from', 'date_to']))
                                                <small class="text-info">
                                                    <i class="fas fa-filter me-1"></i>Filter aktif
                                                    <a href="{{ request()->url() }}"
                                                        class="text-decoration-none ms-1">(Reset)</a>
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Table -->
                                <div class="table-responsive p-3">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="ps-4">#</th>
                                                <th>Peminjam</th>
                                                <th>Judul Buku</th>
                                                <th>Gambar</th>
                                                <th class="text-center">Tgl Pinjam</th>
                                                <th class="text-center">Tgl Kembali</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Aksi</th>
                                                <th class="text-center">Hapus</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($peminjamans as $pinjam)
                                                <tr>
                                                    <td class="ps-4">
                                                        {{ ($peminjamans->currentPage() - 1) * $peminjamans->perPage() + $loop->iteration }}
                                                    </td>
                                                    <td>{{ $pinjam->user->name }}</td>
                                                    <td>{{ $pinjam->lemari->judul }}</td>
                                                    <td>
                                                        @if ($pinjam->lemari->image)
                                                            <img src="{{ asset('storage/images/' . $pinjam->lemari->image) }}"
                                                                width="60" class="rounded" alt>
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
                                                        <span
                                                            class="badge bg-{{ $pinjam->status === 'disetujui' ? 'success' : ($pinjam->status === 'ditolak' ? 'danger' : 'primary') }}">
                                                            {{ ucfirst($pinjam->status) }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center">
                                                        @if (Auth::user()->isAdmin())
                                                            <form
                                                                action="{{ route('peminjaman.updateStatus', $pinjam->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                <select name="status" class="form-select form-select-sm"
                                                                    onchange="this.form.submit()">
                                                                    @foreach (['menunggu', 'disetujui', 'ditolak'] as $st)
                                                                        <option value="{{ $st }}"
                                                                            {{ $pinjam->status === $st ? 'selected' : '' }}>
                                                                            {{ ucfirst($st) }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </form>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <form action="{{ route('peminjaman.destroy', $pinjam->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Yakin hapus peminjaman ini?')"
                                                            class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-link text-danger p-0" title="Hapus">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="9" class="text-center text-secondary py-4">
                                                        <i class="fas fa-book-open me-1"></i> Tidak ada data peminjaman
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                {{-- Pagination --}}
                                @if ($peminjamans->hasPages())
                                    <div class="px-3 pt-3 d-flex justify-content-end">
                                        {{ $peminjamans->appends(request()->query())->links('pagination::bootstrap-4') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .page-wrapper {
                display: flex;
                min-height: 100vh;
            }

            .menu-sidebar2 {
                position: fixed;
                left: 0;
                top: 0;
                width: 250px;
                height: 100vh;
                background: #333;
                z-index: 1000;
                overflow-y: auto;
            }

            .page-content-wrapper {
                flex: 1;
                margin-left: 250px;
                background: #f8f9fa;
            }

            .main-content {
                padding: 0;
                min-height: 100vh;
            }

            .avatar {
                width: 2rem;
                height: 2rem;
            }

            .avatar-title {
                width: 100%;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.875rem;
                font-weight: 600;
            }

            .table th {
                border-top: none;
                font-weight: 600;
                font-size: 0.75rem;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                color: #6c757d;
            }

            .form-label {
                font-weight: 500;
                margin-bottom: 0.25rem;
                font-size: 0.8rem;
            }

            .text-sm {
                font-size: 0.875rem;
            }

            .text-xs {
                font-size: 0.75rem;
            }

            /* Custom pagination styles */
            .pagination {
                margin-bottom: 0;
            }

            .page-link {
                padding: 0.375rem 0.75rem;
                margin-left: -1px;
                color: #6c757d;
                text-decoration: none;
                background-color: #fff;
                border: 1px solid #dee2e6;
            }

            .page-item.active .page-link {
                z-index: 3;
                color: #fff;
                background-color: #007bff;
                border-color: #007bff;
            }

            .page-link:hover {
                z-index: 2;
                color: #0056b3;
                text-decoration: none;
                background-color: #e9ecef;
                border-color: #dee2e6;
            }

            /* Responsive */
            @media (max-width: 768px) {
                .menu-sidebar2 {
                    transform: translateX(-100%);
                    transition: transform 0.3s ease;
                }

                .menu-sidebar2.show {
                    transform: translateX(0);
                }

                .page-content-wrapper {
                    margin-left: 0;
                }

                .table-responsive {
                    font-size: 0.8rem;
                }

                .form-select-sm,
                .form-control-sm {
                    font-size: 0.75rem;
                }
            }

            /* Loading state for form submissions */
            .form-select:disabled {
                opacity: 0.6;
                cursor: not-allowed;
            }
        </style>
    @endpush


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-submit form when per_page changes
            const perPageSelect = document.getElementById('per_page');
            if (perPageSelect) {
                perPageSelect.addEventListener('change', function() {
                    this.form.submit();
                });
            }

            // Add loading state to status update forms
            const statusSelects = document.querySelectorAll('select[name="status"]');
            statusSelects.forEach(select => {
                select.addEventListener('change', function() {
                    this.disabled = true;
                    this.style.opacity = '0.6';
                });
            });

            // Mobile menu functionality
            const menuButton = document.querySelector('.mobile-menu-btn');
            const sidebar = document.querySelector('.menu-sidebar2');
            const overlay = document.querySelector('.sidebar-overlay');

            if (menuButton) {
                menuButton.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                    if (overlay) overlay.classList.toggle('show');
                });
            }

            if (overlay) {
                overlay.addEventListener('click', function() {
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                });
            }

            // Enhanced search functionality
            const searchInput = document.querySelector('input[name="search"]');
            if (searchInput) {
                let searchTimeout;
                searchInput.addEventListener('input', function() {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        // You can add instant search functionality here if needed
                    }, 500);
                });
            }

            // Date range validation
            const dateFrom = document.querySelector('input[name="date_from"]');
            const dateTo = document.querySelector('input[name="date_to"]');

            if (dateFrom && dateTo) {
                dateFrom.addEventListener('change', function() {
                    dateTo.min = this.value;
                });

                dateTo.addEventListener('change', function() {
                    dateFrom.max = this.value;
                });
            }
        });
    </script>
@endpush

@endsection
