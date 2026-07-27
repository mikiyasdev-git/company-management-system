<?php $__env->startSection('content'); ?>
<h1>Create New Task</h1>

<?php if($errors->any()): ?>
    <div class="alert alert-danger mt-3">
        <ul class="mb-0">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?php echo e(route('tasks.store')); ?>" method="POST" class="card card-body shadow-sm mt-3">
    <?php echo csrf_field(); ?>

    <div class="mb-3">
        <label class="form-label">Task Title</label>
        <input type="text" name="title" class="form-control" value="<?php echo e(old('title')); ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3"><?php echo e(old('description')); ?></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Project</label>
        <select name="project_id" class="form-select" required>
            <option value="">-- Select Project --</option>
            <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($project->id); ?>" <?php echo e(old('project_id') == $project->id ? 'selected' : ''); ?>>
                    <?php echo e($project->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Assign To</label>
        <select name="assigned_to" class="form-select" required>
            <option value="">-- Select Employee --</option>
            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($employee->id); ?>" <?php echo e(old('assigned_to') == $employee->id ? 'selected' : ''); ?>>
                    <?php echo e($employee->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="mb-3">
    <label class="form-label">Priority</label>

    <select name="priority" class="form-select" required>

        <option value="">-- Select Priority --</option>

        <option value="high">
            High
        </option>

        <option value="medium">
            Medium
        </option>

        <option value="low">
            Low
        </option>

    </select>

</div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select" required>
            <option value="todo">To Do</option>
            <option value="in_progress">In Progress</option>
            <option value="done">Done</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Create Task</button>
</form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Hp\Desktop\laravel\my-first-app\resources\views/tasks/create.blade.php ENDPATH**/ ?>