@extends('layouts.app')

@section('title', 'Edit Pengumuman')

@section('content')
<h3 class="mb-4">Edit Pengumuman</h3>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.pengumuman.update', $pengumuman) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" name="judul" value="{{ old('judul', $pengumuman->judul) }}"
                    class="form-control @error('judul') is-invalid @enderror">
                @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Isi Pengumuman</label>
                <textarea name="isi" rows="4" class="form-control @error('isi') is-invalid @enderror">{{ old('isi', $pengumuman->isi) }}</textarea>
                @error('isi') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            @if ($pengumuman->gambar)
            <div class="mb-2">
                <img src="{{ asset('storage/' . $pengumuman->gambar) }}" width="120" class="rounded border">
            </div>
            @endif

            <div class="mb-3">
                <label class="form-label">Ganti Gambar (opsional)</label>
                <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror">
                @error('gambar') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Link Video (opsional)</label>
                <input type="url" name="video" value="{{ old('video', $pengumuman->video) }}"
                    class="form-control @error('video') is-invalid @enderror" placeholder="https://youtube.com/...">
                @error('video') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection