@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-6">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 mb-0 text-dark-emphasis">Profil Saya</h2>
                <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary">
                    <i class="bi bi-pencil-fill me-1"></i> Edit Profil
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="d-flex gap-4 flex-column flex-md-row">
                <!-- Avatar Box -->
                <div class="bg-body-tertiary p-4 rounded-3 text-center shadow-sm" style="width: 180px; flex-shrink: 0;">
                    @if(auth()->user()->avatar)
                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}"
                            alt="Avatar"
                            class="rounded-circle mb-3"
                            style="width: 120px; height: 120px; object-fit: cover;">
                    @else
                        <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 120px; height: 120px;">
                            <span class="text-primary">No Avatar</span>
                        </div>
                    @endif
                    <div class="text-body-emphasis mt-2 fw-medium">{{ auth()->user()->name }}</div>
                    <span class="badge bg-info bg-opacity-10 text-info mt-2">
                        {{ auth()->user()->role }}
                    </span>
                </div>

                <!-- Profile Details Box -->
                <div class="bg-body-tertiary p-4 rounded-3 flex-grow-1 shadow-sm">
                    <div class="text-body">
                    <div class="profile-item mb-4">
                            <div class="text-body-secondary mb-1 small">Nama Lengkap</div>
                            <div class="fw-medium">{{ old('name', auth()->user()->name) }}</div>
                        </div>
                        <div class="profile-item mb-4">
                            <div class="text-body-secondary mb-1 small">Username</div>
                            <div class="fw-medium">{{ auth()->user()->username }}</div>
                        </div>
                        <div class="profile-item mb-4">
                            <div class="text-body-secondary mb-1 small">Email</div>
                            <div class="fw-medium">{{ auth()->user()->email }}</div>
                        </div>
                        <div class="profile-item mb-4">
                            <div class="text-body-secondary mb-1 small">Tanggal Lahir</div>
                            <div class="fw-medium">
                                {{ auth()->user()->dob ? \Carbon\Carbon::parse(auth()->user()->dob)->format('d F Y') : '-' }}
                            </div>
                        </div>
                        <div class="profile-item">
                            <div class="text-body-secondary mb-1 small">Bergabung Pada</div>
                            <div class="fw-medium">{{ auth()->user()->created_at->format('d F Y H:i') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
