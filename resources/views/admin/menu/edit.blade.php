@extends('layouts.app')

@section('title', 'Edit Menu')

@section('content')
<h3 class="mb-4">Edit Menu</h3>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.menu.update', $menu) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Menu</label>
                <input type="text" name="nama_menu" value="{{ old('nama_menu', $menu->nama_menu) }}"
                    class="form-control @error('nama_menu') is-invalid @enderror">
                @error('nama_menu') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $menu->deskripsi) }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Harga (Rp)</label>
                    <input type="number" name="harga" value="{{ old('harga', $menu->harga) }}" step="0.01"
                        class="form-control @error('harga') is-invalid @enderror">
                    @error('harga') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" name="kategori" value="{{ old('kategori', $menu->kategori) }}" class="form-control">
                </div>
            </div>

            @if ($menu->gambar)
            <div class="mb-2"><img src="{{ asset('storage/' . $menu->gambar) }}" width="100" class="rounded border"></div>
            @endif

            <div class="mb-3">
                <label class="form-label">Ganti Gambar (opsional)</label>
                <input type="file" name="gambar" class="form-control">
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" name="tersedia" value="1" class="form-check-input" id="tersedia" {{ $menu->tersedia ? 'checked' : '' }}>
                <label class="form-check-label" for="tersedia">Tersedia</label>
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" name="unggulan" value="1" class="form-check-input" id="unggulan" {{ $menu->unggulan ? 'checked' : '' }}>
                <label class="form-check-label" for="unggulan">Tampilkan sebagai Menu Unggulan di halaman depan</label>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection