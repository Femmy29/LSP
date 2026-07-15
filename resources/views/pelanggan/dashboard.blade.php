@extends('layouts.app')

@section('title', 'Dashboard Pelanggan')

@section('content')
<h3 class="mb-4">Selamat Datang, {{ auth()->user()->name }}!</h3>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card card-elegant-1 shadow-sm h-100">
            <div class="card-body">
                <h6 class="card-title">Lihat Menu</h6>
                <p class="card-text small">Pesan menu makanan & minuman favorit Anda</p>
                <a href="{{ route('pelanggan.menu.index') }}" class="btn btn-sm">Lihat Menu</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-elegant-3 shadow-sm h-100">
            <div class="card-body">
                <h6 class="card-title">Pesanan Saya</h6>
                <p class="card-text small">Cek status pesanan & upload bukti bayar</p>
                <a href="{{ route('pelanggan.pesanan.index') }}" class="btn btn-sm">Lihat Pesanan</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-elegant-4 shadow-sm h-100">
            <div class="card-body">
                <h6 class="card-title">Pengumuman</h6>
                <p class="card-text small">Info & promo terbaru dari restoran</p>
                <a href="{{ route('pelanggan.pengumuman.index') }}" class="btn btn-sm">Lihat Pengumuman</a>
            </div>
        </div>
    </div>
</div>
@endsection