@extends('layouts.app')

@section('title', 'Tambah Menu')

@section('content')
<h3 class="mb-4">Tambah Menu</h3>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Menu</label>
                <input type="text" name="nama_menu" value="{{ old('nama_menu') }}"
                    class="form-control @error('nama_menu') is-invalid @enderror">
                @error('nama_menu') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control">{{ old('deskripsi') }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Harga (Rp)</label>
                    <input type="number" name="harga" value="{{ old('harga') }}" step="0.01"
                        class="form-control @error('harga') is-invalid @enderror">
                    @error('harga') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" name="kategori" value="{{ old('kategori') }}" class="form-control" placeholder="Makanan / Minuman">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar Menu</label>
                <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror">
                @error('gambar') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" name="tersedia" value="1" class="form-check-input" id="tersedia" checked>
                <label class="form-check-label" for="tersedia">Tersedia</label>
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" name="unggulan" value="1" class="form-check-input" id="unggulan">
                <label class="form-check-label" for="unggulan">Tampilkan sebagai Menu Unggulan di halaman depan</label>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection