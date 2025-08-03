@extends($layout)

@section('content')

    @php
        use Illuminate\Support\Str;
    @endphp

    {{-- Admin-only Section --}}
    <section id="admin-berita" class="blog-details section" data-aos="fade-up">
        <div class="container">
            @if (auth()->user()->isAdmin())
                <h2 class="mb-4">Dashboard Admin - Daftar Berita</h2>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Gambar</th>
                                <th>Judul</th>
                                <th>isi</th>
                                <th>Slug</th>
                                <th>Penulis</th>
                                <th>Tanggal Publish</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <div class="mb-3 text-end">
                                <a href="{{ route('berita.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus-circle"></i> Tambah Berita Baru
                                </a>
                            </div>
                            @forelse ($beritas as $b)
                                <tr>
                                    <td class="text-center">
                                        @if ($b->gambar)
                                            <img src="{{ asset('storage/images/' . $b->gambar) }}" width="80"
                                                class="img-thumbnail" alt="Gambar Berita">
                                        @else
                                            <span class="badge bg-secondary">No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $b->judul }}</td>
                                    <td>{{ Str::limit(strip_tags($b->isi), 25, '...') }}</td>
                                    <td>{{ Str::limit(strip_tags($b->slug), 10, '...') }}</td>
                                    <td>{{ $b->penulis }}</td>
                                    <td>{{ $b->tanggal_publish->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('berita.edit', $b->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('berita.destroy', $b->id) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Hapus berita ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada berita.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-danger">
                    <strong>Akses ditolak:</strong> Halaman ini hanya bisa diakses oleh admin.
                </div>
            @endif
        </div>
    </section>
@endsection
