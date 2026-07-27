<?php $__env->startSection('content'); ?>
<h1>Users</h1>

<?php if(session('success')): ?>
    <div class="alert alert-success mt-3"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<form method="GET" action="<?php echo e(route('users.index')); ?>" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control"
               placeholder="Search by name or email..."
               value="<?php echo e(request('search')); ?>">
        <button class="btn btn-primary" type="submit">Search</button>
    </div>
</form>

<div class="card shadow-sm mt-3">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($u->name); ?></td>
                        <td><?php echo e($u->email); ?></td>
                        <td><?php echo e($u->roles->pluck('name')->join(', ')); ?></td>
                        <td>
                            <?php if($u->is_active): ?>
                                <span class="badge bg-success">Active</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Inactive</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-end">
                            <?php if(auth()->user()->hasPermission('edit_users')): ?>
                                <a href="<?php echo e(route('users.edit', $u->id)); ?>" class="btn btn-sm btn-outline-primary">Edit</a>

                                <form action="<?php echo e(route('users.toggle', $u->id)); ?>" method="POST" class="d-inline">
                 <?php echo csrf_field(); ?>
             <?php echo method_field('PATCH'); ?>
                                    <button type="submit" class="btn btn-sm btn-outline-warning">
                                        <?php echo e($u->is_active ? 'Deactivate' : 'Activate'); ?>

                                    </button>
                                </form>
                            <?php endif; ?>

                            <?php if(auth()->user()->hasPermission('delete_users') && $u->id !== auth()->id()): ?>
                                <form action="<?php echo e(route('users.destroy', $u->id)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Delete this user? This cannot be undone.')">
                                        Delete
                                    </button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>

<?php if(auth()->user()->hasPermission('create_users')): ?>
    <a href="<?php echo e(route('users.create')); ?>" class="btn btn-primary mt-3">+ Add User</a>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Hp\Desktop\laravel\my-first-app\resources\views/users/index.blade.php ENDPATH**/ ?>