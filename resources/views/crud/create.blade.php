@extends(Auth::user()->isAdmin() ? 'layout.admin' : 'layout.user')

@section('content')
<div class="container mt-4">
    <h2>Tambah Buku</h2>

    <form action="{{ route('crud.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control" name="judul" required>
        </div>
        <div class="mb-3">
            <label for="penerbit" class="form-label">Penerbit</label>
            <input type="text" class="form-control" name="penerbit" required>
        </div>
        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <input type="text" class="form-control" name="kategori" required>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control" name="stock" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Gambar Buku (Opsional)</label>
            <input type="file" class="form-control" name="image" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('crud.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
