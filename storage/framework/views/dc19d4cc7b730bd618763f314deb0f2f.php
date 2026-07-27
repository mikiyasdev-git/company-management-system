

<!DOCTYPE html>
<html>

<head>

<title>Liqawunt Dashboard</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<style>

.sidebar-link:hover{
    background-color:#343a40;
    border-radius:8px;
}

/* Sidebar fixed width on desktop */
.sidebar-desktop {
    width: 250px;
    min-width: 250px;
}

/* Hide desktop sidebar, show hamburger below 992px (lg breakpoint) */
@media (max-width: 991.98px) {
    .sidebar-desktop {
        display: none;
    }
}

/* Hide hamburger on desktop */
@media (min-width: 992px) {
    .navbar-toggler-custom {
        display: none;
    }
}

</style>

</head>

<body>

<!-- Navbar -->
<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="d-flex">

    <!-- Sidebar Area (desktop only, offcanvas handles mobile) -->
    <div class="sidebar-desktop">
        <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <!-- Main Content -->
    <!-- to add a back button when we visit different page-->
    <div class="p-4 flex-grow-1" style="min-width:0;">
        <?php if (! (request()->is('admin/dashboard') || request()->is('employee/dashboard'))): ?>
            <button onclick="history.back()" class="btn btn-outline-secondary btn-sm mb-3">
                <i class="bi bi-arrow-left"></i> Back
            </button>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </div>

</div>

<!-- Offcanvas Sidebar (mobile only) -->
<div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="mobileSidebar">
    <div class="offcanvas-header">
        <h5 class="mb-0">🚀 Liqawunt</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body p-0">
        <?php echo $__env->make('layouts.sidebar-links-only', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
</div>



</body>

</html>
<?php /**PATH C:\Users\Hp\Desktop\laravel\my-first-app\resources\views/layouts/app.blade.php ENDPATH**/ ?>