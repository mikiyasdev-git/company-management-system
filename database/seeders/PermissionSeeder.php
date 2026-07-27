<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(): void
    {
        $permissions = [
            // Projects
            'view_projects', 'create_projects', 'edit_projects', 'delete_projects',
            // Tasks
            'view_tasks', 'create_tasks', 'edit_tasks', 'delete_tasks', 'assign_tasks',
            // Reports
'view_reports', 'create_reports', 'edit_reports', 'delete_reports', 'approve_reports',
            // Users
            'view_users', 'create_users', 'edit_users', 'delete_users',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}

