@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <h4 class="mb-4">Edit Paket</h4>

    <form action="{{ route('paket.update', $paket) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="id_referensi" class="form-label">ID Referensi</label>
            <input type="text" name="id_referensi" class="form-control" value="{{ old('id_referensi', $paket->id_referensi) }}" required>
        </div>

        <div class="mb-3">
            <label for="nama_pengirim" class="form-label">Nama Pengirim</label>
            <input type="text" name="nama_pengirim" class="form-control" value="{{ old('nama_pengirim', $paket->nama_pengirim) }}" required>
        </div>

        <div class="mb-3">
            <label for="nama_penerima" class="form-label">Nama Penerima</label>
            <input type="text" name="nama_penerima" class="form-control" value="{{ old('nama_penerima', $paket->nama_penerima) }}" required>
        </div>

        <div class="mb-3">
            <label for="jenis_paket" class="form-label">Jenis Paket</label>
            <input type="text" name="jenis_paket" class="form-control" value="{{ old('jenis_paket', $paket->jenis_paket) }}" required>
        </div>

        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <input type="text" name="kategori" class="form-control" value="{{ old('kategori', $paket->kategori) }}" required>
        </div>

        <div class="mb-3">
            <label for="berat_kg" class="form-label">Berat (kg)</label>
            <input type="text" name="berat_kg" class="form-control" value="{{ old('berat_kg', $paket->berat_kg) }}" required>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga (IDR)</label>
            <input type="number" name="harga" class="form-control" value="{{ old('harga', $paket->harga) }}" required>
        </div>

        <div class="mb-3">
            <label for="alamat_tujuan" class="form-label">Alamat Tujuan</label>
            <input type="text" name="alamat_tujuan" class="form-control" value="{{ old('alamat_tujuan', $paket->alamat_tujuan) }}" required>
        </div>

        <div class="mb-3">
            <label for="jenis_pengiriman" class="form-label">Jenis Pengiriman</label>
            <select name="jenis_pengiriman" class="form-control">
                <option value="cargo" {{ $paket->jenis_pengiriman == 'cargo' ? 'selected' : '' }}>Cargo</option>
                <option value="motor" {{ $paket->jenis_pengiriman == 'motor' ? 'selected' : '' }}>Motor</option>
                <option value="mobil" {{ $paket->jenis_pengiriman == 'mobil' ? 'selected' : '' }}>Mobil</option>
            </select>
        </div>

        <!-- Dropdown untuk Status Paket -->
        <div class="mb-3">
            <label for="status" class="form-label">Status Paket</label>
            <select name="status" class="form-control" required>
                <option value="Baru" {{ $paket->status == 'Baru' ? 'selected' : '' }}>Baru</option>
                <option value="Pending" {{ $paket->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Delay" {{ $paket->status == 'Delay' ? 'selected' : '' }}>Delay</option>
                <option value="Selesai" {{ $paket->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
