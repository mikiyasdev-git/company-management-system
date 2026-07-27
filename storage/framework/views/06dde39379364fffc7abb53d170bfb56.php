<?php $__env->startSection('content'); ?>
<h1>Submit Report</h1>

<?php if($errors->any()): ?>
    <div class="alert alert-danger mt-3">
        <ul class="mb-0">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?php echo e(route('reports.store')); ?>" method="POST" enctype="multipart/form-data" class="card card-body shadow-sm mt-3">
    <?php echo csrf_field(); ?>

    <?php if(Auth::user()->hasRole('Manager') || Auth::user()->hasRole('System Administrator')): ?>
        <div class="mb-3">
            <label class="form-label">Employee</label>
            <select name="user_id" class="form-select" required>
                <option value="">-- Select Employee --</option>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($u->id); ?>" <?php echo e(old('user_id') == $u->id ? 'selected' : ''); ?>>
                        <?php echo e($u->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    <?php endif; ?>

    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control" value="<?php echo e(old('title')); ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3" required><?php echo e(old('description')); ?></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Project (optional)</label>
        <select name="project_id" class="form-select">
            <option value="">-- None --</option>
            <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($project->id); ?>" <?php echo e(old('project_id') == $project->id ? 'selected' : ''); ?>>
                    <?php echo e($project->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Task (optional)</label>
        <select name="task_id" class="form-select">
            <option value="">-- None --</option>
            <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($task->id); ?>" <?php echo e(old('task_id') == $task->id ? 'selected' : ''); ?>>
                    <?php echo e($task->title); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Report Date</label>
        <input type="date" name="report_date" class="form-control" value="<?php echo e(old('report_date', date('Y-m-d'))); ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Attach Files (PDF, images, video, docs)</label>
        <input type="file" name="files[]" class="form-control" multiple>
        <small class="text-muted">Max 20MB per file.</small>
    </div>

    <button type="submit" class="btn btn-primary">Submit Report</button>
</form>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Hp\Desktop\laravel\my-first-app\resources\views/reports/create.blade.php ENDPATH**/ ?>