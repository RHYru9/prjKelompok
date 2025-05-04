@extends('layouts.master')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div style="position: relative; height: 40px;">
        <div class="d-flex align-items-center gap-2" style="position: absolute; top: -15px;">
            <a href="/profile" class="text-decoration-none d-inline-flex align-items-center py-2 px-1 bg-light rounded">
                <i class="bi bi-chevron-left fs-2 me-2 text-primary"></i>
                <span class="fs-7 text-primary">Kembali ke Profil</span>
            </a>
        </div>
    </div>
        {{-- Box Avatar --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Avatar</h5>
                </div>
                <div class="card-body text-center p-4">
                    {{-- Box dalam Box untuk Avatar --}}
                    <div class="border rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                         style="width: 160px; height: 160px; border: 2px dashed #dee2e6;">
                        @if(auth()->user()->avatar)
                            <img id="avatarPreview"
                                 src="{{ asset('storage/' . auth()->user()->avatar) }}"
                                 alt="Current Avatar"
                                 class="rounded-circle"
                                 style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <div id="avatarPreview"
                                 class="bg-secondary rounded-circle d-flex align-items-center justify-content-center"
                                 style="width: 150px; height: 150px;">
                                <span class="text-white fs-1">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                            </div>
                        @endif
                    </div>

                    {{-- Form Upload Avatar --}}
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <input type="file"
                                   id="avatar"
                                   name="avatar"
                                   class="form-control-file @error('avatar') is-invalid @enderror"
                                   accept="image/jpeg,image/png">
                            @error('avatar')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <small class="form-text text-muted d-block mt-2">
                                Format: JPG/PNG, maksimal 2MB
                            </small>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Simpan Avatar</button>
                    </form>

                    {{-- Menampilkan lokasi avatar setelah upload --}}
                    @if(session('avatar_path'))
                        <div class="alert alert-success mt-3">
                            Avatar berhasil di-upload! Lokasi file: <a href="{{ asset('storage/' . session('avatar_path')) }}" target="_blank">{{ session('avatar_path') }}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Box Form Informasi Profil --}}
        <div class="col-md-8 mb-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Edit Profil</h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        {{-- Info Umum --}}
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', auth()->user()->name) }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text"
                                   id="username"
                                   name="username"
                                   class="form-control @error('username') is-invalid @enderror"
                                   value="{{ old('username', auth()->user()->username) }}">
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email', auth()->user()->email) }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="dob" class="form-label">Tanggal Lahir</label>
                            <input type="date"
                                   id="dob"
                                   name="dob"
                                   class="form-control @error('dob') is-invalid @enderror"
                                   value="{{ old('dob', auth()->user()->dob) }}">
                            @error('dob')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <hr class="my-4">

                        {{-- Ubah Password --}}
                        <h5 class="mb-3">Ubah Password</h5>
                        <div class="alert alert-info">
                            Kosongkan field password jika tidak ingin mengubah password.
                        </div>

                        <div class="form-group mb-3">
                            <label for="current_password" class="form-label">Password Saat Ini</label>
                            <input type="password"
                                   id="current_password"
                                   name="current_password"
                                   class="form-control @error('current_password') is-invalid @enderror">
                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="new_password" class="form-label">Password Baru</label>
                            <input type="password"
                                   id="new_password"
                                   name="new_password"
                                   class="form-control @error('new_password') is-invalid @enderror">
                            @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <small class="form-text text-muted">
                                Minimal 8 karakter, mengandung huruf besar, huruf kecil, angka, dan simbol.
                            </small>
                        </div>

                        <div class="form-group mb-4">
                            <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password"
                                   id="new_password_confirmation"
                                   name="new_password_confirmation"
                                   class="form-control">
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('profile.index') }}" class="btn btn-outline-secondary">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Script Preview Avatar --}}
<script>
    document.getElementById('avatar').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('avatarPreview');
                if (preview.tagName === 'IMG') {
                    preview.src = e.target.result;
                } else {
                    const newPreview = document.createElement('img');
                    newPreview.id = 'avatarPreview';
                    newPreview.src = e.target.result;
                    newPreview.className = 'rounded-circle';
                    newPreview.style.width = '150px';
                    newPreview.style.height = '150px';
                    newPreview.style.objectFit = 'cover';
                    preview.parentNode.replaceChild(newPreview, preview);
                }
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
