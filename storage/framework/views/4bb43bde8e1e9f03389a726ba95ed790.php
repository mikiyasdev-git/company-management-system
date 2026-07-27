

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 mt-5">

                <div class="card shadow p-4">

                    <h3 class="text-center mb-4">Create Account</h3>

                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(url('/register')); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <div class="mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Fullname">
                        </div>

                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email">
                        </div>

                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Register</button>

                        <div class="text-center mt-3">
                            <a href="/login">Already have an account? Login</a>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>

</body>
</html>
<?php /**PATH C:\Users\Hp\Desktop\laravel\my-first-app\resources\views/register.blade.php ENDPATH**/ ?>