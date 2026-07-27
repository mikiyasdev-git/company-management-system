<?php $__env->startSection('content'); ?>
<h1>Welcome to Liqawunt Dashboard</h1>
<div class="row">


<div class="col-md-3">

<div class="card shadow">

<div class="card-body">
<a href="<?php echo e(route('users.index')); ?>">
<h5>
Users
</h5>
</a>
<h2>
<?php echo e($totalUsers); ?>

</h2>


</div>

</div>

</div>



<div class="col-md-3">

<div class="card shadow">

<div class="card-body">
<a href="<?php echo e(route('projects.index')); ?>">
<h5>
Projects
</h5>
</a>
<h2>
<?php echo e($totalProjects); ?>

</h2>


</div>

</div>

</div>



<div class="col-md-3">

<div class="card shadow">

<div class="card-body">
<a href="<?php echo e(route('tasks.index')); ?>">
<h5>
Tasks
</h5>
</a>
<h2>
<?php echo e($totalTasks); ?>

</h2>


</div>

</div>

</div>


<div class="col-md-3">

<div class="card shadow">

<div class="card-body">
<a href="<?php echo e(route('reports.index')); ?>">
<h5>
Reports
</h5>
</a>
<h2>
<?php echo e($totalReports); ?>

</h2>


</div>

</div>

</div>


</div>
<h3 class="mt-5">
Quick Actions
</h3>

<div class="d-flex flex-wrap gap-2">

    <a href="<?php echo e(route('projects.index')); ?>" class="btn btn-primary">
        Create Project
    </a>

    <a href="<?php echo e(route('users.index')); ?>" class="btn btn-success">
         User
    </a>

    <a href="<?php echo e(route('tasks.index')); ?>" class="btn btn-warning">
        View Tasks
    </a>

    <a href="<?php echo e(route('reports.index')); ?>" class="btn btn-secondary">
        View Reports
    </a>

</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Hp\Desktop\laravel\my-first-app\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>