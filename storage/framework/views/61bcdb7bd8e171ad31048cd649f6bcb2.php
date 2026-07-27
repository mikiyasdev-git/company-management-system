<?php $__env->startSection('content'); ?>
<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Task Details</h3>
            <a href="<?php echo e(url()->previous()); ?>" class="btn btn-light btn-sm">Back</a>
        </div>

        <div class="card-body">

            <dl class="row mb-0">
                <dt class="col-sm-3">Title</dt>
                <dd class="col-sm-9"><?php echo e($task->title); ?></dd>

                <dt class="col-sm-3">Project</dt>
                <dd class="col-sm-9"><?php echo e($task->project->name ?? 'No Project'); ?></dd>

                <dt class="col-sm-3">Assigned To</dt>
                <dd class="col-sm-9"><?php echo e(optional($task->user)->name ?? 'Not Assigned'); ?></dd>

                <dt class="col-sm-3">Description</dt>
                <dd class="col-sm-9"><?php echo e($task->description ?? 'No description provided.'); ?></dd>

                <dt class="col-sm-3">Status</dt>
                <dd class="col-sm-9">
                    <span class="badge bg-info text-dark"><?php echo e($task->status); ?></span>
                </dd>

                <dt class="col-sm-3">Priority</dt>
                <dd class="col-sm-9">
                    <span class="badge bg-warning text-dark"><?php echo e($task->priority); ?></span>
                </dd>

                <dt class="col-sm-3">Deadline</dt>
                <dd class="col-sm-9"><?php echo e($task->deadline ?? 'No Deadline'); ?></dd>
            </dl>

            <div class="mt-3">
                <a href="<?php echo e(route('tasks.edit', $task->id)); ?>" class="btn btn-warning btn-sm">Edit Task</a>
            </div>

            <div class="mt-3">
    <form action="<?php echo e(route('tasks.updateStatus', $task->id)); ?>" method="POST" class="d-flex align-items-center gap-2">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PATCH'); ?>

        <label class="form-label mb-0">Update Status:</label>

        <select name="status" class="form-select w-auto">
            <option value="todo" <?php if($task->status == 'todo'): ?> selected <?php endif; ?>>To Do</option>
            <option value="in_progress" <?php if($task->status == 'in_progress'): ?> selected <?php endif; ?>>In Progress</option>
            <option value="done" <?php if($task->status == 'done'): ?> selected <?php endif; ?>>Done</option>
        </select>

        <button type="submit" class="btn btn-success btn-sm">Save</button>
    </form>
</div>

        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Hp\Desktop\laravel\my-first-app\resources\views/tasks/show.blade.php ENDPATH**/ ?>