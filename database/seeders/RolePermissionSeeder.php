<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sysAdmin = Role::where('name', 'System Administrator')->first();
        $manager = Role::where('name', 'Manager')->first();
        $employee = Role::where('name', 'Employee')->first();

        // System Administrator: every permission
        $sysAdmin->permissions()->sync(Permission::all()->pluck('id'));

        // Manager: everything except deleting users
        $manager->permissions()->sync(
            Permission::where('name', '!=',  'delete_users')->pluck('id')
        );

        // Employee: view-only + create/edit their own tasks and reports
        $employee->permissions()->sync(
            Permission::whereIn('name', [
                'view_projects',
                'view_tasks', 'create_tasks', 'edit_tasks',
                'view_reports', 'create_reports',
            ])->pluck('id')
        );
    }
}
