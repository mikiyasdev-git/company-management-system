<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <div class="card shadow-sm">

        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Edit Task</h3>
        </div>

        <div class="card-body">

            <form action="<?php echo e(route('tasks.update',$task->id)); ?>" method="POST">

                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <!-- Project -->
                <div class="mb-3">
                    <label class="form-label">Project</label>

                    <select name="project_id" class="form-select">

                        <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <option value="<?php echo e($project->id); ?>"
                                <?php if($task->project_id == $project->id): ?>
                                    selected
                                <?php endif; ?>>

                                <?php echo e($project->name); ?>


                            </option>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </select>
                </div>

                <!-- Assigned To -->
                <div class="mb-3">
                    <label class="form-label">Assigned To</label>

                    <select name="assigned_to" class="form-select">

                        <option value="">Not Assigned</option>

                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <option value="<?php echo e($user->id); ?>"
                                <?php if($task->assigned_to == $user->id): ?>
                                    selected
                                <?php endif; ?>>

                                <?php echo e($user->name); ?>


                            </option>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </select>
                </div>

                <!-- Title -->
                <div class="mb-3">
                    <label class="form-label">Title</label>

                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        value="<?php echo e($task->title); ?>">
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label class="form-label">Description</label>

                    <textarea
                        name="description"
                        rows="4"
                        class="form-control"><?php echo e($task->description); ?></textarea>
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label class="form-label">Status</label>

                    <select name="status" class="form-select">

                        <option value="pending"
                            <?php if($task->status=='pending'): ?> selected <?php endif; ?>>
                            Pending
                        </option>

                        <option value="active"
                            <?php if($task->status=='active'): ?> selected <?php endif; ?>>
                            Active
                        </option>

                        <option value="completed"
                            <?php if($task->status=='completed'): ?> selected <?php endif; ?>>
                            Completed
                        </option>

                    </select>
                </div>

                <!-- Priority -->
                <div class="mb-3">
                    <label class="form-label">Priority</label>

                    <select name="priority" class="form-select">

                        <option value="low"
                            <?php if($task->priority=='low'): ?> selected <?php endif; ?>>
                            Low
                        </option>

                        <option value="medium"
                            <?php if($task->priority=='medium'): ?> selected <?php endif; ?>>
                            Medium
                        </option>

                        <option value="high"
                            <?php if($task->priority=='high'): ?> selected <?php endif; ?>>
                            High
                        </option>

                    </select>
                </div>

                <!-- Deadline -->
                <div class="mb-4">
                    <label class="form-label">Deadline</label>

                    <input
                        type="date"
                        name="deadline"
                        class="form-control"
                        value="<?php echo e($task->deadline); ?>">
                </div>

                <!-- Buttons -->
                <div class="d-flex gap-2">

                    <button type="submit" class="btn btn-primary">
                        Update Task
                    </button>

                    <a href="<?php echo e(route('tasks.index')); ?>" class="btn btn-secondary">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php /**PATH C:\Users\Hp\Desktop\laravel\my-first-app\resources\views/tasks/edit.blade.php ENDPATH**/ ?>