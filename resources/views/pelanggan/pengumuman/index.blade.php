@extends('layouts.app')

@section('title', 'Pengumuman')

@section('content')
<h3 class="mb-4">Pengumuman</h3>

<div class="row g-3">
    @forelse ($pengumuman as $item)
    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            @if ($item->gambar)
            <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="{{ $item->judul }}">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $item->judul }}</h5>
                <p class="card-text small">{{ $item->isi }}</p>
                @if ($item->video)
                <div class="ratio ratio-16x9 mb-2">
                    <iframe src="{{ $item->video }}" title="{{ $item->judul }}" allowfullscreen></iframe>
                </div>
                @endif
            </div>
        </div>
    </div>
    @empty
    <p class="text-muted">Belum ada pengumuman.</p>
    @endforelse
</div>

<div class="mt-3">{{ $pengumuman->links() }}</div>
@endsection