<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $sysAdminRole = Role::where('name', 'System Administrator')->first();

        $admin = User::firstOrCreate(
            ['email' => 'admin@liqawunt.com'], // change to your real email
            [
                'name' => 'System Administrator',
                'password' => Hash::make('2205@Admin'),
            ]
        );

        // avoid attaching the role twice if the seeder runs again
        if (! $admin->roles->contains($sysAdminRole->id)) {
            $admin->roles()->attach($sysAdminRole->id);
        }
    }
}
