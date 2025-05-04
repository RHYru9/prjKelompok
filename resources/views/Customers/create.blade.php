@extends('layouts.master')

@section('title', 'Tambah Customer')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Tambah Customer Baru</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('customer.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required>
            @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" required>
                <option value="">-- Pilih Role --</option>
                <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>
                <option value="driver" {{ old('role') == 'driver' ? 'selected' : '' }}>Driver</option>
            </select>
            @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group position-relative">
            <label for="password">Password</label>
            <div class="input-group">
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                <div class="input-group-append">
                    <span class="input-group-text toggle-password" data-target="#password" style="cursor:pointer;">👁️</span>
                </div>
            </div>
            <small class="form-text text-muted">
                Password harus memenuhi kriteria berikut:
                <ul>
                    <li>Minimal 8 karakter</li>
                    <li>Mengandung huruf besar (A-Z)</li>
                    <li>Mengandung huruf kecil (a-z)</li>
                    <li>Mengandung karakter khusus (!@#$%^&*(),.?":{}|&lt;&gt;)</li>
                </ul>
            </small>
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group position-relative">
            <label for="password_confirmation">Konfirmasi Password</label>
            <div class="input-group">
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                <div class="input-group-append">
                    <span class="input-group-text toggle-password" data-target="#password_confirmation" style="cursor:pointer;">👁️</span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="nomer_rekening">Nomor Rekening</label>
            <input type="text" name="nomer_rekening" id="nomer_rekening" class="form-control @error('nomer_rekening') is-invalid @enderror" value="{{ old('nomer_rekening') }}" maxlength="14">
            @error('nomer_rekening') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="nama_rekening">Nama Rekening</label>
            <input type="text" name="nama_rekening" id="nama_rekening" class="form-control @error('nama_rekening') is-invalid @enderror" value="{{ old('nama_rekening') }}">
            @error('nama_rekening') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="dob">Tanggal Lahir</label>
            <input type="date" name="dob" id="dob" class="form-control @error('dob') is-invalid @enderror" value="{{ old('dob') }}">
            @error('dob') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('customer.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const passwordFeedback = document.createElement('div');
    passwordFeedback.className = 'invalid-feedback';
    passwordInput.parentNode.appendChild(passwordFeedback);

    passwordInput.addEventListener('input', function() {
        const password = this.value;
        let errors = [];

        if (password.length < 8) errors.push('Minimal 8 karakter');
        if (!/[A-Z]/.test(password)) errors.push('Harus mengandung huruf besar');
        if (!/[a-z]/.test(password)) errors.push('Harus mengandung huruf kecil');
        if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) errors.push('Harus mengandung karakter khusus');

        if (errors.length > 0) {
            passwordFeedback.textContent = 'Password belum memenuhi: ' + errors.join(', ');
            passwordFeedback.style.display = 'block';
            this.classList.add('is-invalid');
        } else {
            passwordFeedback.textContent = '';
            passwordFeedback.style.display = 'none';
            this.classList.remove('is-invalid');
        }
    });

    document.querySelectorAll('.toggle-password').forEach(function(toggle) {
        toggle.addEventListener('click', function() {
            const targetInput = document.querySelector(this.dataset.target);
            if (targetInput.type === 'password') {
                targetInput.type = 'text';
                this.textContent = '🙈';
            } else {
                targetInput.type = 'password';
                this.textContent = '👁️';
            }
        });
    });
});
</script>
@endsection
