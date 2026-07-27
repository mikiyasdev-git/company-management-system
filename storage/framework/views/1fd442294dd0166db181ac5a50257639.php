<?php $__env->startSection('content'); ?>

<div class="container-fluid">

    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Welcome, <?php echo e(Auth::user()->name); ?></h2>
            <p class="text-muted">Employee Dashboard</p>
        </div>

        <a href="<?php echo e(route('reports.create')); ?>" class="btn btn-success">
            + Create Report
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>


    
    <div class="row">

        <div class="col-md-3 mb-3">

            <div class="card border-0 shadow">

                <div class="card-body">

                    <h6 class="text-muted">
                        My Projects
                    </h6>

                    <h2><?php echo e($myProjects); ?></h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="card border-0 shadow">

                <div class="card-body">

                    <h6 class="text-muted">
                        Assigned Tasks
                    </h6>

                    <h2><?php echo e($myTasks); ?></h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="card border-0 shadow">

                <div class="card-body">

                    <h6 class="text-muted">
                        My Reports
                    </h6>

                    <h2><?php echo e($myReports); ?></h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="card border-0 shadow">

                <div class="card-body">

                    <h6 class="text-muted">
                        Completion
                    </h6>

                    <h2><?php echo e($taskCompletionRate); ?>%</h2>

                    <div class="progress mt-3">

                        <div class="progress-bar bg-success"
                            style="width: <?php echo e($taskCompletionRate); ?>%">
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    
    <div class="card shadow mt-4">

        <div class="card-header bg-primary text-white">

            <h5 class="mb-0">
                Assigned Tasks
            </h5>

        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead>

                <tr>

                    <th>Title</th>

                    <th>Project</th>

                    <th>Status</th>

                    <th>Deadline</th>

                    <th>Action</th>

                </tr>

                </thead>

                <tbody>

                <?php $__empty_1 = true; $__currentLoopData = $assignedTasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                    <tr>

                        <td><?php echo e($task->title); ?></td>

                        <td>
                            <?php echo e(optional($task->project)->name); ?>

                        </td>

                        <td>

                            <?php if($task->status=="Pending"): ?>

                                <span class="badge bg-warning">
                                    Pending
                                </span>

                            <?php elseif($task->status=="In Progress"): ?>

                                <span class="badge bg-info">
                                    In Progress
                                </span>

                            <?php else: ?>

                                <span class="badge bg-success">
                                    Completed
                                </span>

                            <?php endif; ?>

                        </td>

                        <td>

                            <?php echo e($task->deadline); ?>


                        </td>

                        <td>

                            <a href="<?php echo e(route('tasks.show',$task->id)); ?>"
                               class="btn btn-sm btn-primary">

                                View

                            </a>

                        </td>

                    </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                    <tr>

                        <td colspan="5" class="text-center">

                            No assigned tasks.

                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>



    
    <div class="card shadow mt-4">

        <div class="card-header bg-success text-white">

            <div class="d-flex justify-content-between">

                <h5 class="mb-0">

                    My Reports

                </h5>

                <a href="<?php echo e(route('reports.index')); ?>"
                   class="btn btn-light btn-sm">

                    View All

                </a>

            </div>

        </div>

        <div class="card-body">

            <table class="table table-striped">

                <thead>

                <tr>

                    <th>Title</th>

                    <th>Status</th>

                    <th>Date</th>

                    <th>Action</th>

                </tr>

                </thead>

                <tbody>

                <?php $__empty_1 = true; $__currentLoopData = $myReportsList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                    <tr>

                        <td><?php echo e($report->title); ?></td>

                        <td>

                            <?php if($report->status=="draft"): ?>

                                <span class="badge bg-warning">
                                    Draft
                                </span>

                            <?php else: ?>

                                <span class="badge bg-success">
                                    Submitted
                                </span>

                            <?php endif; ?>

                        </td>

                        <td>

                            <?php echo e($report->report_date); ?>


                        </td>

                        <td>

                            <?php if($report->status=="draft"): ?>

                                <a href="<?php echo e(route('reports.edit',$report->id)); ?>"
                                   class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                            <?php else: ?>

                                <a href="<?php echo e(route('reports.show',$report->id)); ?>"
                                   class="btn btn-secondary btn-sm">

                                    View

                                </a>

                            <?php endif; ?>

                        </td>

                    </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                    <tr>

                        <td colspan="4"
                            class="text-center">

                            No reports found.

                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>



    
    <div class="card shadow mt-4">

        
<div class="card shadow mt-4">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            Recent Activities
        </h5>

        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addActivityModal">
            + Add Activity
        </button>

    </div>

    <div class="card-body">

        <ul class="list-group">

            <?php $__empty_1 = true; $__currentLoopData = $recentActivities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                <li class="list-group-item">

                    <strong>
                        <?php echo e($activity->title); ?>

                    </strong>

                    <br>

                    <?php echo e($activity->description); ?>


                    <br>

                    <small class="text-muted">
                        <?php echo e($activity->activity_date); ?>

                    </small>

                </li>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                <li class="list-group-item">
                    No activities yet.
                </li>

            <?php endif; ?>

        </ul>

    </div>

</div>


<div class="modal fade" id="addActivityModal" tabindex="-1" aria-labelledby="addActivityModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="<?php echo e(route('activities.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="modal-header">
                    <h5 class="modal-title" id="addActivityModalLabel">Add Activity</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="<?php echo e(old('title')); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3" required><?php echo e(old('description')); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" name="activity_date" class="form-control" value="<?php echo e(old('activity_date', date('Y-m-d'))); ?>" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Activity</button>
                </div>

            </form>

        </div>
    </div>
</div>

    </div>

</div>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Hp\Desktop\laravel\my-first-app\resources\views/employee/dashboard.blade.php ENDPATH**/ ?>