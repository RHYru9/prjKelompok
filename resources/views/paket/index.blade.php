@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <h4 class="mb-4">Data Paket</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('paket.create') }}" class="btn btn-primary mb-3">+ Tambah Paket</a>

    <!-- Form Pencarian -->
    <form action="{{ route('paket.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan ID Referensi, Pengirim, Penerima, dll" value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Cari</button>
        </div>
    </form>

    <div class="card">
        <div class="card-body p-0">
            <table class="table mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID Referensi</th>
                        <th>Pengirim</th>
                        <th>Penerima</th>
                        <th>Jenis</th>
                        <th>Kategori</th>
                        <th>Berat (kg)</th>
                        <th>Harga</th>
                        <th>Tujuan</th>
                        <th>Pengiriman</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pakets as $paket)
                        <tr>
                            <td>{{ $paket->id_referensi }}</td>
                            <td>{{ $paket->nama_pengirim }}</td>
                            <td>{{ $paket->nama_penerima }}</td>
                            <td>{{ $paket->jenis_paket }}</td>
                            <td>{{ $paket->kategori }}</td>
                            <td>{{ $paket->berat_kg }}</td>
                            <td>Rp {{ number_format($paket->harga, 0, ',', '.') }}</td>
                            <td>{{ $paket->alamat_tujuan }}</td>
                            <td>{{ ucfirst($paket->jenis_pengiriman) }}</td>

                            <!-- Status dengan Emoji -->
                            <td>
                                @php
                                    $statusEmoji = '';
                                    switch($paket->status) {
                                        case 'Baru':
                                            $statusEmoji = '🟥 Baru';  // Merah
                                            break;
                                        case 'Pending':
                                            $statusEmoji = '🟠 Pending';  // Oranye
                                            break;
                                        case 'Delay':
                                            $statusEmoji = '🟡 Delay';  // Kuning
                                            break;
                                        case 'Selesai':
                                            $statusEmoji = '🟢 Selesai';  // Hijau
                                            break;
                                    }
                                @endphp
                                <span>{{ $statusEmoji }}</span>
                            </td>

                            <td>
                                <a href="{{ route('paket.edit', $paket) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('paket.destroy', $paket) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center text-muted">Data belum tersedia. Silakan tambahkan data paket.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
