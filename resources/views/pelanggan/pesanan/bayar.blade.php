@extends('layouts.app')

@section('title', 'Upload Bukti Pembayaran')

@section('content')
<h3 class="mb-4">Upload Bukti Pembayaran - Pesanan #{{ $pesanan->id }}</h3>

<div class="card shadow-sm">
    <div class="card-body">
        <p>Total yang harus dibayar: <strong>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</strong></p>

        <form action="{{ route('pelanggan.pembayaran.store', $pesanan) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Metode Pembayaran</label>
                <select name="metode_pembayaran" class="form-select @error('metode_pembayaran') is-invalid @enderror">
                    <option value="">-- Pilih Metode --</option>
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="E-Wallet">E-Wallet</option>
                </select>
                @error('metode_pembayaran') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Bukti Transfer</label>
                <input type="file" name="bukti_transfer" class="form-control @error('bukti_transfer') is-invalid @enderror">
                @error('bukti_transfer') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Kirim Bukti Pembayaran</button>
            <a href="{{ route('pelanggan.pesanan.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection