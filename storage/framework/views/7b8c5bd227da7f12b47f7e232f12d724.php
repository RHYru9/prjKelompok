<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <h4 class="mb-4">Data Paket</h4>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <a href="<?php echo e(route('paket.create')); ?>" class="btn btn-primary mb-3">+ Tambah Paket</a>

    <!-- Form Pencarian -->
    <form action="<?php echo e(route('paket.index')); ?>" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan ID Referensi, Pengirim, Penerima, dll" value="<?php echo e(request('search')); ?>">
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
                    <?php $__empty_1 = true; $__currentLoopData = $pakets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($paket->id_referensi); ?></td>
                            <td><?php echo e($paket->nama_pengirim); ?></td>
                            <td><?php echo e($paket->nama_penerima); ?></td>
                            <td><?php echo e($paket->jenis_paket); ?></td>
                            <td><?php echo e($paket->kategori); ?></td>
                            <td><?php echo e($paket->berat_kg); ?></td>
                            <td>Rp <?php echo e(number_format($paket->harga, 0, ',', '.')); ?></td>
                            <td><?php echo e($paket->alamat_tujuan); ?></td>
                            <td><?php echo e(ucfirst($paket->jenis_pengiriman)); ?></td>

                            <!-- Status dengan Emoji -->
                            <td>
                                <?php
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
                                ?>
                                <span><?php echo e($statusEmoji); ?></span>
                            </td>

                            <td>
                                <a href="<?php echo e(route('paket.edit', $paket)); ?>" class="btn btn-sm btn-warning">Edit</a>
                                <form action="<?php echo e(route('paket.destroy', $paket)); ?>" method="POST" style="display:inline-block;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="11" class="text-center text-muted">Data belum tersedia. Silakan tambahkan data paket.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/rey/semester4/DUMMY/kurir/DONE/Skote_Html_Laravel_v4.2.3/Laravel/Admin/resources/views/paket/index.blade.php ENDPATH**/ ?>