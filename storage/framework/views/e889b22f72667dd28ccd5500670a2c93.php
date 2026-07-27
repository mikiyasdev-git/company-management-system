<?php $__env->startSection('content'); ?>
<h1>Edit Project</h1>

<?php if($errors->any()): ?>
    <div class="alert alert-danger mt-3">
        <ul class="mb-0">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?php echo e(route('projects.update', $project->id)); ?>" method="POST" class="card card-body shadow-sm mt-3">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" value="<?php echo e(old('name', $project->name)); ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3"><?php echo e(old('description', $project->description)); ?></textarea>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Start Date</label>
            <input type="date" name="start_date" class="form-control" value="<?php echo e(old('start_date', $project->start_date)); ?>" required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">End Date</label>
            <input type="date" name="end_date" class="form-control" value="<?php echo e(old('end_date', $project->end_date)); ?>">
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Assign To</label>
        <select name="user_id" class="form-select" required>
            <option value="">-- Select Employee --</option>
            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($employee->id); ?>"
                    <?php echo e(old('user_id', $project->user_id) == $employee->id ? 'selected' : ''); ?>>
                    <?php echo e($employee->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select" required>
            <option value="pending" <?php echo e(old('status', $project->status) == 'pending' ? 'selected' : ''); ?>>
                Pending
            </option>
            <option value="active" <?php echo e(old('status', $project->status) == 'active' ? 'selected' : ''); ?>>
                Active
            </option>
            <option value="completed" <?php echo e(old('status', $project->status) == 'completed' ? 'selected' : ''); ?>>
                Completed
            </option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">
        Update Project
    </button>
</form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Hp\Desktop\laravel\my-first-app\resources\views/projects/edit.blade.php ENDPATH**/ ?>