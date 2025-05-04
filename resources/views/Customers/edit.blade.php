@extends('layouts.master')

@section('title', 'Edit Customer')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Customer</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('customer.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $customer->name) }}" required>
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $customer->username) }}" required>
            @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $customer->email) }}" required>
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="nomer_rekening">Nomor Rekening</label>
            <input type="text" name="nomer_rekening" id="nomer_rekening" class="form-control @error('nomer_rekening') is-invalid @enderror" value="{{ old('nomer_rekening', $customer->nomer_rekening) }}">
            @error('nomer_rekening') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="nama_rekening">Nama Rekening</label>
            <input type="text" name="nama_rekening" id="nama_rekening" class="form-control @error('nama_rekening') is-invalid @enderror" value="{{ old('nama_rekening', $customer->nama_rekening) }}">
            @error('nama_rekening') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir', $customer->tanggal_lahir) }}">
            @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="password">Password Baru (Kosongkan jika tidak ingin mengubah)</label>
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
            <small class="form-text text-muted">
                Password harus mengandung minimal 8 karakter, huruf besar, huruf kecil, dan karakter khusus.
            </small>
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
            @error('password_confirmation') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('customer.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection
