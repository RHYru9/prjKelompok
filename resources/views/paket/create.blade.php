@extends('layouts.master')

@section('title')
    @lang('translation.paket')
@endsection

@section('css')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">{{ __('Tambah Paket Baru') }}</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('paket.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="id_referensi" class="form-label">{{ __('ID Referensi') }}</label>
                    <input type="text" class="form-control @error('id_referensi') is-invalid @enderror" id="id_referensi" name="id_referensi" value="{{ old('id_referensi') }}" required>
                    @error('id_referensi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nama_pengirim" class="form-label">{{ __('Nama Pengirim') }}</label>
                    <input type="text" class="form-control @error('nama_pengirim') is-invalid @enderror" id="nama_pengirim" name="nama_pengirim" value="{{ old('nama_pengirim') }}" required>
                    @error('nama_pengirim')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nama_penerima" class="form-label">{{ __('Nama Penerima') }}</label>
                    <input type="text" class="form-control @error('nama_penerima') is-invalid @enderror" id="nama_penerima" name="nama_penerima" value="{{ old('nama_penerima') }}" required>
                    @error('nama_penerima')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="jenis_paket" class="form-label">{{ __('Jenis Paket') }}</label>
                    <input type="text" class="form-control @error('jenis_paket') is-invalid @enderror" id="jenis_paket" name="jenis_paket" value="{{ old('jenis_paket') }}" required>
                    @error('jenis_paket')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kategori" class="form-label">{{ __('Kategori') }}</label>
                    <input type="text" class="form-control @error('kategori') is-invalid @enderror" id="kategori" name="kategori" value="{{ old('kategori') }}" required>
                    @error('kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="berat_kg" class="form-label">{{ __('Berat (kg)') }}</label>
                    <input type="number" step="0.01" class="form-control @error('berat_kg') is-invalid @enderror" id="berat_kg" name="berat_kg" value="{{ old('berat_kg') }}" required>
                    @error('berat_kg')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">{{ __('Harga (IDR)') }}</label>
                    <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga') }}" required>
                    @error('harga')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="alamat_tujuan" class="form-label">{{ __('Alamat Tujuan') }}</label>
                    <input type="text" class="form-control @error('alamat_tujuan') is-invalid @enderror" id="alamat_tujuan" name="alamat_tujuan" value="{{ old('alamat_tujuan') }}" required>
                    @error('alamat_tujuan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="jenis_pengiriman" class="form-label">{{ __('Jenis Pengiriman') }}</label>
                    <select class="form-control @error('jenis_pengiriman') is-invalid @enderror" id="jenis_pengiriman" name="jenis_pengiriman" required>
                        <option value="cargo" {{ old('jenis_pengiriman') == 'cargo' ? 'selected' : '' }}>{{ __('Cargo') }}</option>
                        <option value="motor" {{ old('jenis_pengiriman') == 'motor' ? 'selected' : '' }}>{{ __('Motor') }}</option>
                        <option value="mobil" {{ old('jenis_pengiriman') == 'mobil' ? 'selected' : '' }}>{{ __('Mobil') }}</option>
                    </select>
                    @error('jenis_pengiriman')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tambahan untuk status tanpa emotikon -->
                <!-- Status Paket -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status Paket</label>
                    <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                        <option value="Baru" {{ old('status') == 'Baru' ? 'selected' : '' }}>Baru</option>
                        <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Delay" {{ old('status') == 'Delay' ? 'selected' : '' }}>Delay</option>
                        <option value="Selesai" {{ old('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary">{{ __('Simpan Paket') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
