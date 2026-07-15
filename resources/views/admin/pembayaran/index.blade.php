@extends('layouts.app')

@section('title', 'Verifikasi Pembayaran')

@section('content')
<h3 class="mb-4">Verifikasi Pembayaran</h3>

<ul class="nav nav-tabs mb-3">
    @foreach (['pending' => 'Menunggu', 'diterima' => 'Diterima', 'ditolak' => 'Ditolak', 'semua' => 'Semua'] as $key => $label)
    <li class="nav-item">
        <a class="nav-link {{ $status === $key ? 'active' : '' }}"
            href="{{ route('admin.pembayaran.index', ['status' => $key]) }}">{{ $label }}</a>
    </li>
    @endforeach
</ul>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Pesanan</th>
                    <th>Pelanggan</th>
                    <th>Metode</th>
                    <th>Bukti Transfer</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pembayaran as $item)
                <tr>
                    <td>#{{ $item->order_id }}</td>
                    <td>{{ $item->order->user->name }}</td>
                    <td>{{ $item->metode_pembayaran ?? '-' }}</td>
                    <td>
                        <a href="{{ asset('storage/' . $item->bukti_transfer) }}" target="_blank">
                            <img src="{{ asset('storage/' . $item->bukti_transfer) }}" alt="Bukti Transfer" width="60" class="rounded border">
                        </a>
                    </td>
                    <td>
                        <span class="badge bg-{{ $item->status === 'diterima' ? 'success' : ($item->status === 'ditolak' ? 'danger' : 'warning') }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td>
                        @if ($item->status === 'pending')
                        <form action="{{ route('admin.pembayaran.terima', $item) }}" method="POST" class="d-inline">
                            @csrf @method('PATCH')
                            <button class="btn btn-sm btn-success" onclick="return confirm('Terima pembayaran ini?')">Terima</button>
                        </form>
                        <form action="{{ route('admin.pembayaran.tolak', $item) }}" method="POST" class="d-inline">
                            @csrf @method('PATCH')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Tolak pembayaran ini?')">Tolak</button>
                        </form>
                        @else
                        <span class="text-muted small">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Tidak ada data.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{ $pembayaran->links() }}
    </div>
</div>
@endsection