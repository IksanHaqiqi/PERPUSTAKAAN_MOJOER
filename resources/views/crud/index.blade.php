@extends( $layout)

@section('styles')
<style>
    .section-title {
        text-align: center;
        padding: 60px 0 40px 0;
    }
    
    .section-title h2 {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 20px;
        color: #2c4964;
        position: relative;
    }
    
    .section-title h2::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 3px;
        background: linear-gradient(90deg, #007bff, #0056b3);
        border-radius: 2px;
    }
    
    .section-title div {
        font-size: 16px;
        color: #6c757d;
    }
    
    .section-title .description-title {
        color: #007bff;
        font-weight: 600;
    }
    
    .book-card {
        transition: all 0.3s ease;
        border-radius: 15px;
        overflow: hidden;
        position: relative;
        background: white;
    }
    
    .book-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0, 123, 255, 0.15) !important;
    }
    
    .book-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #007bff, #0056b3);
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 1;
    }
    
    .book-card:hover::before {
        opacity: 1;
    }
    
    .card-image-wrapper {
        position: relative;
        overflow: hidden;
        border-radius: 15px 15px 0 0;
    }
    
    .no-image-placeholder {
        background: linear-gradient(135deg, #f1f3f4, #e8eaed);
        border: 2px dashed #dadce0;
        transition: all 0.3s ease;
    }
    
    .book-card:hover .no-image-placeholder {
        background: linear-gradient(135deg, #e3f2fd, #bbdefb);
        border-color: #007bff;
    }
    
    .no-image-placeholder i {
        color: #5f6368;
        transition: color 0.3s ease;
    }
    
    .book-card:hover .no-image-placeholder i {
        color: #007bff;
    }
    
    .no-image-placeholder span {
        color: #5f6368;
        font-size: 14px;
        font-weight: 500;
        transition: color 0.3s ease;
    }
    
    .book-card:hover .no-image-placeholder span {
        color: #007bff;
    }
    
    .card-image-wrapper img {
        transition: transform 0.3s ease;
    }
    
    .book-card:hover .card-image-wrapper img {
        transform: scale(1.05);
    }
    
    .category-badge {
        background: linear-gradient(135deg, #007bff, #0056b3);
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 20px;
        padding: 5px 12px;
        font-size: 12px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: white;
        box-shadow: 0 2px 8px rgba(0, 123, 255, 0.2);
    }
    
    .stock-info {
        background: rgba(0, 123, 255, 0.1);
        border-radius: 10px;
        padding: 8px 12px;
        margin: 8px 0;
        transition: background 0.3s ease;
    }
    
    .book-card:hover .stock-info {
        background: rgba(0, 123, 255, 0.15);
    }
    
    .stock-out .stock-info {
        background: rgba(108, 117, 125, 0.1);
    }
    
    .btn-action {
        border-radius: 25px;
        font-weight: 500;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .btn-action::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s ease;
    }
    
    .btn-action:hover::before {
        left: 100%;
    }
    
    .btn-primary-custom {
        background: linear-gradient(135deg, #007bff, #0056b3);
        border: none;
        color: white;
    }
    
    .btn-primary-custom:hover {
        background: linear-gradient(135deg, #0056b3, #004085);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
        color: white;
    }
    
    .admin-buttons {
        gap: 8px;
    }
    
    .admin-buttons .btn {
        flex: 1;
        border-radius: 20px;
        font-size: 13px;
    }
    
    .btn-outline-warning:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 193, 7, 0.3);
    }
    
    .btn-outline-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
    }
    
    .btn-outline-secondary:hover {
        transform: none;
        box-shadow: none;
    }
    
    .add-book-btn {
        background: linear-gradient(135deg, #28a745, #20c997);
        border: none;
        border-radius: 25px;
        padding: 12px 24px;
        font-weight: 600;
        transition: all 0.3s ease;
        color: white;
    }
    
    .add-book-btn:hover {
        background: linear-gradient(135deg, #20c997, #17a2b8);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        color: white;
    }
    
    .no-books-alert {
        background: linear-gradient(135deg, #e3f2fd, #bbdefb);
        border: none;
        border-radius: 15px;
        padding: 40px;
        text-align: center;
    }
    
    .publisher-info {
        margin-bottom: 12px;
    }
    
    .publisher-info small {
        color: #6c757d;
        font-size: 13px;
    }
    
    .card-title {
        line-height: 1.3;
        margin-bottom: 12px;
        min-height: 48px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection

@section('content')
    <div class="container-fluid container-xl px-4 py-3">
        <!-- Add Book Button for Admin -->
        @if (Auth::user()->isAdmin())
            <div class="text-end mb-2 ">
                <a href="{{ route('crud.create') }}" class="btn add-book-btn ">
                    <i class="bi bi-plus-circle me-2"></i> Tambah Buku
                </a>
            </div>
        @endif

        <!-- Books Grid -->
        <div class="row g-4">
            @forelse ($lemaris as $lemari)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm book-card {{ $lemari->stock == 0 ? 'stock-out' : '' }}">
                        <div class="card-image-wrapper">
                            <div class="position-relative">
                                @if ($lemari->image)
                                    <img src="{{ asset('storage/' . $lemari->image) }}" 
                                         class="card-img-top" 
                                         style="height: 200px; object-fit: cover; width: 100%;" 
                                         alt="{{ $lemari->judul }}">
                                @else
                                    <div class="card-img-top no-image-placeholder d-flex align-items-center justify-content-center" 
                                         style="height: 200px;">
                                        <span class="text-center">
                                            <i class="bi bi-image" style="font-size: 3rem;"></i>
                                            <br>No Image Available
                                        </span>
                                    </div>
                                @endif
                                
                                @if ($lemari->stock > 0)
                                    <span class="badge category-badge position-absolute top-0 start-0 m-2 bg-primary">
                                        {{ $lemari->kategori }}
                                    </span>
                                @else
                                    <span class="badge bg-secondary position-absolute top-0 start-0 m-2 bg-primary">
                                        {{ $lemari->kategori }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="card-body d-flex flex-column text-dark">
                            <h5 class="card-title fw-bold text-truncate mb-3">{{ $lemari->judul }}</h5>
                            
                            <div class="publisher-info mb-2">
                                <small class="text-muted d-block mb-1">
                                    <i class="bi bi-building me-1"></i> {{ $lemari->penerbit }}
                                </small>
                            </div>
                            
                            @if ($lemari->stock > 0)
                                <div class="stock-info text-center">
                                    <small class="fw-semibold text-primary">
                                        <i class="bi bi-box-seam me-1"></i> Stok: {{ $lemari->stock }}
                                    </small>
                                </div>
                            @else
                                <div class="stock-info text-center bg-light">
                                    <small class="fw-semibold text-muted">
                                        <i class="bi bi-box-seam me-1"></i> Stok: {{ $lemari->stock }}
                                    </small>
                                </div>
                            @endif
                            
                            <div class="mt-auto pt-3">
                                @if (Auth::user()->isAdmin())
                                    <div class="d-flex admin-buttons">
                                        <a href="{{ route('crud.edit', $lemari->id) }}"
                                           class="btn btn-outline-warning btn-action">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <form action="{{ route('crud.destroy', $lemari->id) }}" method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-action m-3">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    @if ($lemari->stock > 0)
                                        <a href="{{ route('peminjaman.create', $lemari->id) }}"
                                           class="btn btn-primary-custom btn-action w-100">
                                            <i class="bi bi-book me-1"></i> Pinjam Buku
                                        </a>
                                    @else
                                        <button class="btn btn-outline-secondary btn-action w-100" disabled>
                                            <i class="bi bi-exclamation-circle me-1"></i> Stok Habis
                                        </button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="no-books-alert d-flex flex-column align-items-center">
                        <i class="bi bi-book display-1 text-primary mb-3"></i>
                        <h4 class="text-primary mb-2">Belum ada buku yang tersedia</h4>
                        <p class="text-muted">Silakan tambahkan buku baru untuk memulai koleksi perpustakaan.</p>
                        @if (Auth::user()->isAdmin())
                            <a href="{{ route('crud.create') }}" class="btn add-book-btn mt-3">
                                <i class="bi bi-plus-circle me-2"></i> Tambah Buku Pertama
                            </a>
                        @endif
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection