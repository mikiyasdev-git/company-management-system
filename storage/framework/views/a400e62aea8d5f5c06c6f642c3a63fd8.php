<?php $__env->startSection('content'); ?>
<div class="container mt-4">

    <h2 class="mb-4">Edit Report</h2>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger mt-3">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="card card-body shadow-sm">

        <form action="<?php echo e(route('reports.update', $report->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-3">
                <label class="form-label">User</label>
                <select name="user_id" class="form-select">
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($user->id); ?>"
                            <?php if($report->user_id == $user->id): ?> selected <?php endif; ?>>
                            <?php echo e($user->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Project</label>
                <select name="project_id" class="form-select">
                    <option value="">No Project</option>
                    <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($project->id); ?>"
                            <?php if($report->project_id == $project->id): ?> selected <?php endif; ?>>
                            <?php echo e($project->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Task</label>
                <select name="task_id" class="form-select">
                    <option value="">No Task</option>
                    <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($task->id); ?>"
                            <?php if($report->task_id == $task->id): ?> selected <?php endif; ?>>
                            <?php echo e($task->title); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo e($report->title); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4"><?php echo e($report->description); ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Report Date</label>
                <input type="date" name="report_date" class="form-control" value="<?php echo e($report->report_date); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="draft" <?php if($report->status == 'draft'): ?> selected <?php endif; ?>>Draft</option>
                    <option value="submitted" <?php if($report->status == 'submitted'): ?> selected <?php endif; ?>>Submitted</option>
                    <option value="approved" <?php if($report->status == 'approved'): ?> selected <?php endif; ?>>Approved</option>
                    <option value="rejected" <?php if($report->status == 'rejected'): ?> selected <?php endif; ?>>Rejected</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Report</button>

        </form>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Hp\Desktop\laravel\my-first-app\resources\views/reports/edit.blade.php ENDPATH**/ ?>