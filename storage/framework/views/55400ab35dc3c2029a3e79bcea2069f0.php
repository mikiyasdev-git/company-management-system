<?php $__env->startSection('content'); ?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h2>Projects</h2>

        <a href="<?php echo e(route('projects.create')); ?>"
           class="btn btn-primary">

            + Add Project

        </a>

    </div>


    <?php if(session('success')): ?>

        <div class="alert alert-success">

            <?php echo e(session('success')); ?>


        </div>

    <?php endif; ?>
  <div class="card shadow">
      <div class="card-body">
        <table class="table table-bordered table-striped">
           <thead class="table-dark">
              <tr>
                 <th>ID</th>
                 <th>Name</th>
                  <th>Status</th>
                  <th>Created</th>
                  <th>Actions</th>
             </tr>
            </thead>
     <tbody>
        <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td> <?php echo e($project->id); ?> </td>
            <td> <?php echo e($project->name); ?> </td>
            <td> <?php if($project->status == 'active'): ?>
                <span class="badge bg-success">Active</span>
                    <?php elseif($project->status == 'completed'): ?>
                 <span class="badge bg-primary"> Completed </span>
                    <?php else: ?>
                <span class="badge bg-warning">Pending</span>

                  <?php endif; ?>
            </td>

            <td><?php echo e($project->created_at ? $project->created_at->format('d M Y') : 'N/A'); ?></td>
            <td><a href="<?php echo e(route('projects.edit',$project->id)); ?>" class="btn btn-sm btn-warning">Edit</a>
                <form action="<?php echo e(route('projects.destroy',$project->id)); ?>"
                                  method="POST" style="display:inline">
                 <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
        <button class="btn btn-sm btn-danger">Delete</button>

                 </form>
             </td>

         </tr>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

       </tbody>

    </table>

    </div>

   </div>

</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Hp\Desktop\laravel\my-first-app\resources\views/projects/index.blade.php ENDPATH**/ ?>