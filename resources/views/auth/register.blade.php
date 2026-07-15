@extends('layouts.app')

@section('title', 'Daftar Akun')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="text-center mb-4">
            <h2 style="color: var(--resto-brown);">Restoran Burger FJ</h2>
            <p class="text-muted">Bergabunglah dan pesan menu favorit Anda</p>
        </div>

        <div class="card shadow-sm" style="border-top: 3px solid var(--resto-gold);">
            <div class="card-body">
                <h4 class="card-title mb-4">Daftar Akun Pelanggan</h4>

                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                            class="form-control @error('phone') is-invalid @enderror">
                        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="address" class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                        @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror">
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Daftar</button>
                </form>

                <p class="text-center mt-3 mb-0">
                    Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection