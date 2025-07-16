



<?php $__env->startSection('content'); ?>

<!-- Card container utama -->
<div class="card">
    <div class="card-body">

        <!-- Header: Judul dan tombol tambah entri -->
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mb-4">
            <h1 class="card-title h3 mb-3 mb-sm-0">Daftar Buku Tamu Kampus</h1>
            
            <a href="<?php echo e(route('guests.create')); ?>" class="btn btn-primary">
                Tambah Tamu Baru
            </a>
        </div>

        
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo e(session('success')); ?>

                
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        
        <div class="mb-4">
            <form action="<?php echo e(route('guests.search')); ?>" method="GET" class="d-flex flex-column flex-sm-row gap-3">
                
                <input type="text" name="query" placeholder="Cari berdasarkan nama, institusi, atau tujuan..."
                       class="form-control flex-grow-1"
                       value="<?php echo e(request('query')); ?>">
                
                <button type="submit" class="btn btn-info text-white">
                    Cari
                </button>
            </form>
        </div>

        
        <?php if($guests->isEmpty()): ?>
            <p class="text-center text-muted py-4">Tidak ada entri buku tamu ditemukan.</p>
        <?php else: ?>
            
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">No. Telepon</th>
                            <th scope="col">Institusi</th>
                            <th scope="col">Tujuan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php $__currentLoopData = $guests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                
                                <td><?php echo e($guest->name); ?></td>
                                <td><?php echo e($guest->email ?? '-'); ?></td> 
                                <td><?php echo e($guest->phone ?? '-'); ?></td>
                                <td><?php echo e($guest->institution ?? '-'); ?></td>
                                <td><?php echo e(Str::limit($guest->purpose, 50)); ?></td> 
                                <td>
                                    <div class="d-flex flex-column flex-sm-row gap-2">
                                        
                                        <a href="<?php echo e(route('guests.edit', $guest->id)); ?>" class="btn btn-warning btn-sm">Edit</a>

                                        
                                        <form action="<?php echo e(route('guests.destroy', $guest->id)); ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus entri ini?');">
                                            <?php echo csrf_field(); ?> 
                                            <?php echo method_field('DELETE'); ?> 
                                            <button type="submit" class="btn btn-danger btn-sm w-100 w-sm-auto">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            
            <div class="mt-4">
                <?php echo e($guests->links('pagination::bootstrap-5')); ?>

            </div>
        <?php endif; ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\buku-tamu-kampus\resources\views/guests/index.blade.php ENDPATH**/ ?>