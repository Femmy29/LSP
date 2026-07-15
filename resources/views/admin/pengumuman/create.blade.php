@extends('layouts.app')

@section('title', 'Tambah Pengumuman')

@section('content')
<h3 class="mb-4">Tambah Pengumuman</h3>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.pengumuman.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" name="judul" value="{{ old('judul') }}"
                    class="form-control @error('judul') is-invalid @enderror">
                @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Isi Pengumuman</label>
                <textarea name="isi" rows="4" class="form-control @error('isi') is-invalid @enderror">{{ old('isi') }}</textarea>
                @error('isi') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar (opsional)</label>
                <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror">
                @error('gambar') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Link Video (opsional, contoh: YouTube)</label>
                <input type="url" name="video" value="{{ old('video') }}"
                    class="form-control @error('video') is-invalid @enderror" placeholder="https://youtube.com/...">
                @error('video') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection