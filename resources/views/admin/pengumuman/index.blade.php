@extends('layouts.app')

@section('title', 'Kelola Pengumuman')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0">Kelola Pengumuman</h3>
    <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-primary">+ Tambah Pengumuman</a>
</div>

<div class="row g-3">
    @forelse ($pengumuman as $item)
    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            @if ($item->gambar)
            <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="{{ $item->judul }}">
            @endif
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ $item->judul }}</h5>
                <p class="card-text small text-muted">{{ Str::limit($item->isi, 100) }}</p>

                @if ($item->video)
                <div class="ratio ratio-16x9 mb-2">
                    <iframe src="{{ $item->video }}" title="{{ $item->judul }}" allowfullscreen></iframe>
                </div>
                @endif

                <div class="mt-auto d-flex gap-2">
                    <a href="{{ route('admin.pengumuman.edit', $item) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                    <form action="{{ route('admin.pengumuman.destroy', $item) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus pengumuman ini?')">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <p class="text-muted">Belum ada pengumuman.</p>
    @endforelse
</div>

<div class="mt-3">
    {{ $pengumuman->links() }}
</div>
@endsection