@extends('layouts.app')

@section('title', 'Verifikasi Pesanan')

@section('content')
<h3 class="mb-4">Verifikasi Pesanan</h3>

<ul class="nav nav-tabs mb-3">
    @foreach (['pending' => 'Menunggu', 'diterima' => 'Diterima', 'ditolak' => 'Ditolak', 'selesai' => 'Selesai', 'semua' => 'Semua'] as $key => $label)
    <li class="nav-item">
        <a class="nav-link {{ $status === $key ? 'active' : '' }}"
            href="{{ route('admin.pesanan.index', ['status' => $key]) }}">{{ $label }}</a>
    </li>
    @endforeach
</ul>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Pelanggan</th>
                    <th>Item Pesanan</th>
                    <th>Total</th>
                    <th>Status</th>
                    @if (in_array($status, ['pending', 'semua']))
                    <th>Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($pesanan as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>
                        <ul class="mb-0 ps-3 small">
                            @foreach ($item->items as $detail)
                            <li>{{ $detail->menu->nama_menu }} x{{ $detail->jumlah }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge bg-{{ $item->status === 'diterima' ? 'success' : ($item->status === 'ditolak' ? 'danger' : ($item->status === 'selesai' ? 'secondary' : 'warning')) }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <@if (in_array($status, ['pending', 'semua' ]))
                        <td>
                        @if ($item->status === 'pending')
                        <form action="{{ route('admin.pesanan.terima', $item) }}" method="POST" class="d-inline">
                            @csrf @method('PATCH')
                            <button class="btn btn-sm btn-success" onclick="return confirm('Terima pesanan ini?')">Terima</button>
                        </form>
                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#tolakModal{{ $item->id }}">Tolak</button>

                        {{-- Modal alasan tolak --}}
                        <div class="modal fade" id="tolakModal{{ $item->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('admin.pesanan.tolak', $item) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tolak Pesanan #{{ $item->id }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <label class="form-label">Alasan (opsional)</label>
                                            <textarea name="catatan" class="form-control"></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-danger">Tolak Pesanan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @else
                        <span class="text-muted small">-</span>
                        @endif
                        </td>
                        @endif
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Tidak ada data.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{ $pesanan->links() }}
    </div>
</div>
@endsection