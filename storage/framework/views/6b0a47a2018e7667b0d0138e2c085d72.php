<?php $__env->startSection('content'); ?>
<h1>User Management</h1>

<?php if(session('success')): ?>
    <div class="alert alert-success mt-3"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<table class="table table-bordered mt-4">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($u->name); ?></td>
                <td><?php echo e($u->email); ?></td>
                <td><?php echo e(ucfirst($u->role)); ?></td>
                <td>
                    <?php if($u->is_active): ?>
                        <span class="badge bg-success">Active</span>
                    <?php else: ?>
                        <span class="badge bg-secondary">Deactivated</span>
                    <?php endif; ?>
                </td>
                <td>
                    <form action="<?php echo e(route('users.toggle', $u->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>
                        <button type="submit" class="btn btn-sm <?php echo e($u->is_active ? 'btn-danger' : 'btn-success'); ?>">
                            <?php echo e($u->is_active ? 'Deactivate' : 'Reactivate'); ?>

                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Hp\Desktop\laravel\my-first-app\resources\views/admin/users/index.blade.php ENDPATH**/ ?>