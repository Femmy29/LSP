@extends('layouts.app')

@section('title', 'Verifikasi Akun')

@section('content')
<h3 class="mb-4">Verifikasi Akun Pelanggan</h3>

<ul class="nav nav-tabs mb-3">
    @foreach (['pending' => 'Menunggu', 'accepted' => 'Diterima', 'rejected' => 'Ditolak', 'semua' => 'Semua'] as $key => $label)
    <li class="nav-item">
        <a class="nav-link {{ $status === $key ? 'active' : '' }}"
            href="{{ route('admin.akun.index', ['status' => $key]) }}">{{ $label }}</a>
    </li>
    @endforeach
</ul>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($akun as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->address }}</td>
                    <td>
                        <span class="badge bg-{{ $item->status === 'accepted' ? 'success' : ($item->status === 'rejected' ? 'danger' : 'warning') }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td>
                        @if ($item->status !== 'accepted')
                        <form action="{{ route('admin.akun.terima', $item) }}" method="POST" class="d-inline">
                            @csrf @method('PATCH')
                            <button class="btn btn-sm btn-success" onclick="return confirm('Terima akun ini?')">Terima</button>
                        </form>
                        @endif
                        @if ($item->status !== 'rejected')
                        <form action="{{ route('admin.akun.tolak', $item) }}" method="POST" class="d-inline">
                            @csrf @method('PATCH')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Tolak akun ini?')">Tolak</button>
                        </form>
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

        {{ $akun->links() }}
    </div>
</div>
@endsection