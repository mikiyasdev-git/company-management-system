


<div class="bg-dark text-white vh-100 p-3">

    <h4 class="mb-4">
        🚀 Liqawunt
    </h4>

    <ul class="nav flex-column">
<?php if(auth()->user()->hasRole('Manager') || auth()->user()->hasRole('System Administrator')): ?>
        <li class="nav-item mb-3">
            <a href="/admin/dashboard" class="nav-link text-white">
                🏠 Dashboard
            </a>
        </li>

        <li class="nav-item mb-3">
            <a href="tasks" class="nav-link text-white">
                 Tasks
            </a>
        </li>

        <li class="nav-item mb-3">
            <a href="projects" class="nav-link text-white">
                📁 Projects
            </a>
        </li>

        <li class="nav-item mb-3">
            <a href="/users" class="nav-link text-white">
                👥 Users
            </a>
        </li>

        <li class="nav-item mb-3">
            <a href="/reports" class="nav-link text-white">
                📊 Reports
            </a>
        </li>
 <?php elseif(auth()->user()->hasRole('Employee')): ?>
        <li class="nav-item mb-3">
            <a href="/employee/dashboard" class="nav-link text-white">
                🏠 Dashboard
            </a>
        </li>

        <li class="nav-item mb-3">
            <a href="/my-reports" class="nav-link text-white">
                📊 My Reports
            </a>
        </li>

        <li class="nav-item mb-3">
            <a href="/my-tasks" class="nav-link text-white">
                My Tasks
            </a>
        </li>

        <li class="nav-item mb-3">
            <a href="/my-projects" class="nav-link text-white">
                📁 My Projects
            </a>
        </li>

 <?php endif; ?>


        <hr>

        <li class="nav-item">
            <a href="#" class="nav-link text-white">
                ⚙ Settings
            </a>
        </li>

    </ul>

</div>
<?php /**PATH C:\Users\Hp\Desktop\laravel\my-first-app\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>