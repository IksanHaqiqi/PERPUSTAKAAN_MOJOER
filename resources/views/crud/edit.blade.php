@extends(Auth::user()->isAdmin() ? 'layout.admin' : 'layout.user')

@section('content')
<div class="container mt-4">
    <h2>Edit Buku</h2>

    <form action="{{ route('crud.update', $lemari->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control" name="judul" value="{{ $lemari->judul }}" required>
        </div>

        <div class="mb-3">
            <label for="penerbit" class="form-label">Penerbit</label>
            <input type="text" class="form-control" name="penerbit" value="{{ $lemari->penerbit }}" required>
        </div>

        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <input type="text" class="form-control" name="kategori" value="{{ $lemari->kategori }}" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control" name="stock" value="{{ $lemari->stock }}" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Gambar Buku</label>
            <input type="file" class="form-control" name="image" accept="image/*">
            @if ($lemari->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $lemari->image) }}" width="120" alt="Cover buku lama">
                    <p class="text-muted">Gambar saat ini</p>
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('crud.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
