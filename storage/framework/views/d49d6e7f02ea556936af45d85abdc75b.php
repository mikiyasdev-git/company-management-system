<?php $__env->startSection('content'); ?>

<div class="container-fluid mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Reports</h2>
        <a href="<?php echo e(route('reports.create')); ?>" class="btn btn-primary">
            + Add Report
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Title</th>
                    <th>User</th>
                    <th>Project</th>
                    <th>Task</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Files</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($report->title); ?></td>
                        <td><?php echo e($report->user->name); ?></td>
                        <td><?php echo e($report->project?->name ?? 'No Project'); ?></td>
                        <td><?php echo e($report->task?->title ?? 'No Task'); ?></td>
                        <td>
                            <?php
                                $badgeClass = match($report->status) {
                                    'approved' => 'bg-success',
                                    'submitted' => 'bg-warning text-dark',
                                    'rejected' => 'bg-danger',
                                    default => 'bg-secondary', // draft
                                };
                            ?>
                            <span class="badge <?php echo e($badgeClass); ?>">
                                <?php echo e(ucfirst($report->status)); ?>

                            </span>

                            <?php if($report->status === 'rejected' && $report->rejection_reason): ?>
                                <div class="small text-danger mt-1">
                                    Reason: <?php echo e($report->rejection_reason); ?>

                                </div>
                            <?php endif; ?>

                            <?php if($report->status === 'approved' && $report->approvedBy): ?>
                                <div class="small text-muted mt-1">
                                    Approved by <?php echo e($report->approvedBy->name); ?>

                                </div>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($report->report_date); ?></td>
                        <td>
                            <?php if($report->files->count()): ?>
                                <?php $__currentLoopData = $report->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(route('report-files.download', $file->id)); ?>" class="d-block">
                                        📎 <?php echo e($file->original_name); ?>

                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <span class="text-muted">No files</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if(auth()->user()->hasPermission('approve_reports') && $report->status === 'submitted'): ?>
                                <form action="<?php echo e(route('reports.approve', $report->id)); ?>" method="POST" style="display:inline">
                                    <?php echo csrf_field(); ?>
                                    <button class="btn btn-success btn-sm" onclick="return confirm('Approve this report?')">
                                        Approve
                                    </button>
                                </form>

                                <button type="button" class="btn btn-outline-danger btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#rejectModal<?php echo e($report->id); ?>">
                                    Reject
                                </button>

                                <div class="modal fade" id="rejectModal<?php echo e($report->id); ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="<?php echo e(route('reports.reject', $report->id)); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Reject Report</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <label class="form-label">Reason for rejection</label>
                                                    <textarea name="rejection_reason" class="form-control" rows="3" required></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Reject</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if($report->user_id === auth()->id() || auth()->user()->hasPermission('edit_reports')): ?>
                                <?php if(auth()->user()->isManagerOrAbove() || in_array($report->status, ['draft', 'rejected'])): ?>
                                    <a href="<?php echo e(route('reports.edit', $report->id)); ?>" class="btn btn-warning btn-sm">
                                        Edit
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if($report->user_id === auth()->id() || auth()->user()->hasPermission('delete_reports')): ?>
                                <form action="<?php echo e(route('reports.destroy', $report->id)); ?>"
                                      method="POST"
                                      style="display:inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Delete this report?')">
                                        Delete
                                    </button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted">
                            No reports found.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Hp\Desktop\laravel\my-first-app\resources\views/reports/index.blade.php ENDPATH**/ ?>