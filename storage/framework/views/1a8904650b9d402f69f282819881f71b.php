<?php $__env->startSection('content'); ?>
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
        
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Avatar</h5>
                </div>
                <div class="card-body text-center p-4">
                    
                    <div class="border rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                         style="width: 160px; height: 160px; border: 2px dashed #dee2e6;">
                        <?php if(auth()->user()->avatar): ?>
                            <img id="avatarPreview"
                                 src="<?php echo e(asset('storage/' . auth()->user()->avatar)); ?>"
                                 alt="Current Avatar"
                                 class="rounded-circle"
                                 style="width: 150px; height: 150px; object-fit: cover;">
                        <?php else: ?>
                            <div id="avatarPreview"
                                 class="bg-secondary rounded-circle d-flex align-items-center justify-content-center"
                                 style="width: 150px; height: 150px;">
                                <span class="text-white fs-1"><?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>

                    
                    <form method="POST" action="<?php echo e(route('profile.update')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="form-group">
                            <input type="file"
                                   id="avatar"
                                   name="avatar"
                                   class="form-control-file <?php $__errorArgs = ['avatar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   accept="image/jpeg,image/png">
                            <?php $__errorArgs = ['avatar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <small class="form-text text-muted d-block mt-2">
                                Format: JPG/PNG, maksimal 2MB
                            </small>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Simpan Avatar</button>
                    </form>

                    
                    <?php if(session('avatar_path')): ?>
                        <div class="alert alert-success mt-3">
                            Avatar berhasil di-upload! Lokasi file: <a href="<?php echo e(asset('storage/' . session('avatar_path'))); ?>" target="_blank"><?php echo e(session('avatar_path')); ?></a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="col-md-8 mb-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Edit Profil</h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('profile.update')); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   value="<?php echo e(old('name', auth()->user()->name)); ?>">
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text"
                                   id="username"
                                   name="username"
                                   class="form-control <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   value="<?php echo e(old('username', auth()->user()->username)); ?>">
                            <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   value="<?php echo e(old('email', auth()->user()->email)); ?>">
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group mb-3">
                            <label for="dob" class="form-label">Tanggal Lahir</label>
                            <input type="date"
                                   id="dob"
                                   name="dob"
                                   class="form-control <?php $__errorArgs = ['dob'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   value="<?php echo e(old('dob', auth()->user()->dob)); ?>">
                            <?php $__errorArgs = ['dob'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <hr class="my-4">

                        
                        <h5 class="mb-3">Ubah Password</h5>
                        <div class="alert alert-info">
                            Kosongkan field password jika tidak ingin mengubah password.
                        </div>

                        <div class="form-group mb-3">
                            <label for="current_password" class="form-label">Password Saat Ini</label>
                            <input type="password"
                                   id="current_password"
                                   name="current_password"
                                   class="form-control <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group mb-3">
                            <label for="new_password" class="form-label">Password Baru</label>
                            <input type="password"
                                   id="new_password"
                                   name="new_password"
                                   class="form-control <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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

                        
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                Simpan Perubahan
                            </button>
                            <a href="<?php echo e(route('profile.index')); ?>" class="btn btn-outline-secondary">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/apple/rey/semester4/DUMMY/kurir/DONE/Skote_Html_Laravel_v4.2.3/Laravel/Admin/resources/views/profile/edit.blade.php ENDPATH**/ ?>