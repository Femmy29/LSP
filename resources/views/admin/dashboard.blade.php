@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<h3 class="mb-4">Dashboard Admin</h3>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card card-elegant-1 shadow-sm h-100">
            <div class="card-body">
                <h6 class="card-title">Akun Menunggu Verifikasi</h6>
                <h2 class="mb-0">{{ $akunPending }}</h2>
                @if ($akunPending > 0)
                <a href="{{ route('admin.akun.index') }}" class="btn btn-sm mt-2">Verifikasi Sekarang</a>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-elegant-2 shadow-sm h-100">
            <div class="card-body">
                <h6 class="card-title">Pesanan Menunggu</h6>
                <h2 class="mb-0">{{ $pesananPending }}</h2>
                @if ($pesananPending > 0)
                <a href="{{ route('admin.pesanan.index') }}" class="btn btn-sm mt-2">Verifikasi Sekarang</a>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-elegant-3 shadow-sm h-100">
            <div class="card-body">
                <h6 class="card-title">Pembayaran Menunggu</h6>
                <h2 class="mb-0">{{ $pembayaranPending }}</h2>
                @if ($pembayaranPending > 0)
                <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-sm mt-2">Verifikasi Sekarang</a>
                @endif
            </div>
        </div>
    </div>
</div>


<div class="row row-cols-1 row-cols-md-2 row-cols-lg-5 g-4">
    <div class="col">
        <div class="card card-elegant-1 shadow-sm h-100">
            <div class="card-body">
                <h6 class="card-title">Verifikasi Akun</h6>
                <p class="card-text small">Kelola pendaftaran akun pelanggan</p>
                <a href="{{ route('admin.akun.index') }}" class="btn btn-sm">Kelola</a>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card card-elegant-2 shadow-sm h-100">
            <div class="card-body">
                <h6 class="card-title">Verifikasi Pesanan</h6>
                <p class="card-text small">Terima/tolak pesanan pelanggan</p>
                <a href="{{ route('admin.pesanan.index') }}" class="btn btn-sm">Kelola</a>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card card-elegant-3 shadow-sm h-100">
            <div class="card-body">
                <h6 class="card-title">Verifikasi Pembayaran</h6>
                <p class="card-text small">Cek bukti transfer pelanggan</p>
                <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-sm">Kelola</a>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card card-elegant-4 shadow-sm h-100">
            <div class="card-body">
                <h6 class="card-title">Pengumuman</h6>
                <p class="card-text small">Kelola pengumuman restoran</p>
                <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-sm">Kelola</a>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card card-elegant-5 shadow-sm h-100">
            <div class="card-body">
                <h6 class="card-title">Kelola Menu</h6>
                <p class="card-text small">Tambah/edit/hapus menu makanan</p>
                <a href="{{ route('admin.menu.index') }}" class="btn btn-sm">Kelola</a>
            </div>
        </div>
    </div>
</div>
@endsection