@extends('layouts.master')

@section('title', __('translation.user_dp'))


@section('content')
<div class="container mt-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0"> {{ __('translation.user_dp') }}</h2>
        <a href="{{ route('customer.create') }}" class="btn btn-success btn-sm py-1 px-3">
            <i class="fas fa-plus"></i> Tambah Customer
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show py-2">
            {{ session('success') }}
            <button type="button" class="btn-close p-2" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Filter Pencarian dan Role -->
    <div class="card mb-3 p-3">
        <form method="GET" action="{{ route('customer.index') }}" class="row g-2 align-items-center">
            <div class="col-md-5">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari customer" value="{{ request()->query('search') }}">
            </div>
            <div class="col-md-3">
                <select name="role" class="form-select form-select-sm">
                    <option value="">Semua Role</option>
                    <option value="customer" {{ request()->query('role') == 'customer' ? 'selected' : '' }}>Customer</option>
                    <option value="driver" {{ request()->query('role') == 'driver' ? 'selected' : '' }}>Driver</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-sm w-100">
                    <i class="fas fa-search"></i> Cari
                </button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('customer.index') }}" class="btn btn-secondary btn-sm w-100">
                    <i class="fas fa-sync"></i> Reset
                </a>
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-sm">
            <thead class="table-light">
                <tr>
                    <th width="5%">ID</th>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Rekening</th>
                    <th>Nama Rekening</th>
                    <th width="12%">Tanggal Lahir</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->username }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->nomer_rekening ?? '-' }}</td>
                        <td>{{ $customer->nama_rekening ?? '-' }}</td>
                        <td>{{ $customer->dob ? \Carbon\Carbon::parse($customer->dob)->format('d-m-Y') : '-' }}</td>
                        <td class="text-nowrap">
                            <a href="{{ route('customer.edit', $customer->id) }}" class="btn btn-warning btn-sm py-0 px-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('customer.destroy', $customer->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus customer ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm py-0 px-2">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-2">Belum ada data customer.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination and items per page -->
    <div class="d-flex justify-content-between align-items-center mt-2">
        <div class="text-muted small">
            Menampilkan {{ $customers->firstItem() }} - {{ $customers->lastItem() }} dari {{ $customers->total() }} data
        </div>

        <div class="d-flex align-items-center">
            <div class="me-3 small text-muted">Baris per halaman:</div>
            <form method="GET" action="{{ route('customer.index') }}" class="form-inline">
                <!-- Include current filters in the form -->
                @if(request()->query('search'))
                    <input type="hidden" name="search" value="{{ request()->query('search') }}">
                @endif
                @if(request()->query('role'))
                    <input type="hidden" name="role" value="{{ request()->query('role') }}">
                @endif

                <select name="per_page" id="per_page" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="10" {{ request()->query('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request()->query('per_page', 10) == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request()->query('per_page', 10) == 50 ? 'selected' : '' }}>50</option>
                </select>
            </form>
            <div class="ms-3">
                {{ $customers->withQueryString()->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

<style>
    .form-select-sm, .form-control-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
    .table th, .table td {
        padding: 0.5rem;
    }
    .pagination {
        margin-bottom: 0;
    }
</style>
@endsection
