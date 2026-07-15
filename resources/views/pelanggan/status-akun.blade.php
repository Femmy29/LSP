@extends('layouts.app')

@section('title', 'Status Akun')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 text-center">
        @php
        $status = auth()->user()->status;
        @endphp

        @if ($status === 'pending')
        <div class="alert alert-warning">
            <h5>⏳ Akun Anda sedang menunggu verifikasi admin.</h5>
            <p class="mb-0">Silakan cek kembali beberapa saat lagi.</p>
        </div>
        @elseif ($status === 'rejected')
        <div class="alert alert-danger">
            <h5>❌ Pendaftaran Anda ditolak.</h5>
            <p class="mb-0">Silakan hubungi admin restoran untuk informasi lebih lanjut.</p>
        </div>
        @endif
    </div>
</div>
@endsection