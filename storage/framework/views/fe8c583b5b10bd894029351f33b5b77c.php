<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Task Management</h3>

            <a href="<?php echo e(route('tasks.create')); ?>" class="btn btn-light">
                + Add Task
            </a>
        </div>

        <div class="card-body">

            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo e(session('success')); ?>


                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Title</th>
                            <th>Project</th>
                            <th>Assigned To</th>
                            <th>Status</th>
                            <th>Priority</th>
                            <th>Deadline</th>
                            <th width="170">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php $__empty_1 = true; $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($task->title); ?></td>

                            <td><?php echo e($task->project->name); ?></td>

                            <td>  <?php echo e(optional($task->user)->name ?? 'Not Assigned'); ?></td>

                            <td>
                                <span class="badge bg-info text-dark">
                                    <?php echo e($task->status); ?>

                                </span>
                            </td>

                            <td>
                                <span class="badge bg-warning text-dark">
                                    <?php echo e($task->priority); ?>

                                </span>
                            </td>

                            <td><?php echo e($task->deadline ?? 'No Deadline'); ?></td>

                            <td>
                                <a href="<?php echo e(route('tasks.edit', $task->id)); ?>"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

    <form action="<?php echo e(route('tasks.destroy',$task->id)); ?>"
      method="POST"
      class="d-inline">

    <?php echo csrf_field(); ?>
    <?php echo method_field('DELETE'); ?>

    <button type="submit"
            class="btn btn-danger btn-sm"
            onclick="return confirm('Delete this task?')">

        Delete

    </button>

</form>
                            </td>
                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                No tasks available.
                            </td>
                        </tr>

                    <?php endif; ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php /**PATH C:\Users\Hp\Desktop\laravel\my-first-app\resources\views/tasks/index.blade.php ENDPATH**/ ?>