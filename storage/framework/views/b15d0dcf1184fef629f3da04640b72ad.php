<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <h4 class="mb-4">Edit Paket</h4>

    <form action="<?php echo e(route('paket.update', $paket)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="mb-3">
            <label for="id_referensi" class="form-label">ID Referensi</label>
            <input type="text" name="id_referensi" class="form-control" value="<?php echo e(old('id_referensi', $paket->id_referensi)); ?>" required>
        </div>

        <div class="mb-3">
            <label for="nama_pengirim" class="form-label">Nama Pengirim</label>
            <input type="text" name="nama_pengirim" class="form-control" value="<?php echo e(old('nama_pengirim', $paket->nama_pengirim)); ?>" required>
        </div>

        <div class="mb-3">
            <label for="nama_penerima" class="form-label">Nama Penerima</label>
            <input type="text" name="nama_penerima" class="form-control" value="<?php echo e(old('nama_penerima', $paket->nama_penerima)); ?>" required>
        </div>

        <div class="mb-3">
            <label for="jenis_paket" class="form-label">Jenis Paket</label>
            <input type="text" name="jenis_paket" class="form-control" value="<?php echo e(old('jenis_paket', $paket->jenis_paket)); ?>" required>
        </div>

        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <input type="text" name="kategori" class="form-control" value="<?php echo e(old('kategori', $paket->kategori)); ?>" required>
        </div>

        <div class="mb-3">
            <label for="berat_kg" class="form-label">Berat (kg)</label>
            <input type="text" name="berat_kg" class="form-control" value="<?php echo e(old('berat_kg', $paket->berat_kg)); ?>" required>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga (IDR)</label>
            <input type="number" name="harga" class="form-control" value="<?php echo e(old('harga', $paket->harga)); ?>" required>
        </div>

        <div class="mb-3">
            <label for="alamat_tujuan" class="form-label">Alamat Tujuan</label>
            <input type="text" name="alamat_tujuan" class="form-control" value="<?php echo e(old('alamat_tujuan', $paket->alamat_tujuan)); ?>" required>
        </div>

        <div class="mb-3">
            <label for="jenis_pengiriman" class="form-label">Jenis Pengiriman</label>
            <select name="jenis_pengiriman" class="form-control">
                <option value="cargo" <?php echo e($paket->jenis_pengiriman == 'cargo' ? 'selected' : ''); ?>>Cargo</option>
                <option value="motor" <?php echo e($paket->jenis_pengiriman == 'motor' ? 'selected' : ''); ?>>Motor</option>
                <option value="mobil" <?php echo e($paket->jenis_pengiriman == 'mobil' ? 'selected' : ''); ?>>Mobil</option>
            </select>
        </div>

        <!-- Dropdown untuk Status Paket -->
        <div class="mb-3">
            <label for="status" class="form-label">Status Paket</label>
            <select name="status" class="form-control" required>
                <option value="Baru" <?php echo e($paket->status == 'Baru' ? 'selected' : ''); ?>>Baru</option>
                <option value="Pending" <?php echo e($paket->status == 'Pending' ? 'selected' : ''); ?>>Pending</option>
                <option value="Delay" <?php echo e($paket->status == 'Delay' ? 'selected' : ''); ?>>Delay</option>
                <option value="Selesai" <?php echo e($paket->status == 'Selesai' ? 'selected' : ''); ?>>Selesai</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/rey/semester4/DUMMY/kurir/DONE/Skote_Html_Laravel_v4.2.3/Laravel/Admin/resources/views/paket/edit.blade.php ENDPATH**/ ?>