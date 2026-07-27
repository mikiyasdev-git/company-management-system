<nav class="navbar navbar-dark bg-dark">

    <div class="container-fluid">

        <div class="d-flex align-items-center">

            <button class="btn btn-dark navbar-toggler-custom me-2"
                    type="button"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#mobileSidebar">
                ☰
            </button>

            <a class="navbar-brand fw-bold mb-0">
                Liqawunt Technologies
            </a>

        </div>

        <div class="d-flex align-items-center">

            <?php if(Auth::user()->profile_picture): ?>
                <img src="<?php echo e(asset('storage/' . Auth::user()->profile_picture)); ?>"
                     alt="Profile"
                     class="rounded-circle me-2"
                     style="width: 32px; height: 32px; object-fit: cover;">
            <?php else: ?>
                <img src="<?php echo e(asset('images/default-avatar.png')); ?>"
                     alt="Profile"
                     class="rounded-circle me-2"
                     style="width: 32px; height: 32px; object-fit: cover;">
            <?php endif; ?>

            <a href="<?php echo e(route('profile.edit')); ?>" class="text-white text-decoration-none me-3 d-none d-sm-inline">
                Welcome back, <?php echo e(Auth::user()->name); ?>

            </a>

            <a href="/logout" class="btn btn-danger btn-sm">
                Logout
            </a>

        </div>

    </div>

</nav>
<?php /**PATH C:\Users\Hp\Desktop\laravel\my-first-app\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>