@extends('layouts.app')

@section('title', 'Kelola Menu')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0">Kelola Menu</h3>
    <a href="{{ route('admin.menu.create') }}" class="btn btn-primary">+ Tambah Menu</a>
</div>

<div class="row g-3">
    @forelse ($menu as $item)
    <div class="col-md-3">
        <div class="card shadow-sm h-100">
            <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : 'https://via.placeholder.com/300x180?text=No+Image' }}"
                class="card-img-top" style="height: 150px; object-fit: cover;" alt="{{ $item->nama_menu }}">
            <div class="card-body d-flex flex-column">
                <h6 class="card-title mb-1">{{ $item->nama_menu }}</h6>
                <p class="small text-muted mb-1">{{ $item->kategori ?? '-' }}</p>
                <p class="fw-bold mb-2">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                <span class="badge bg-{{ $item->tersedia ? 'success' : 'secondary' }} mb-2">
                    {{ $item->tersedia ? 'Tersedia' : 'Habis' }}
                </span>
                <div class="mt-auto d-flex gap-2">
                    <a href="{{ route('admin.menu.edit', $item) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                    <form action="{{ route('admin.menu.destroy', $item) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus menu ini?')">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <p class="text-muted">Belum ada menu.</p>
    @endforelse
</div>

<div class="mt-3">{{ $menu->links() }}</div>
@endsection