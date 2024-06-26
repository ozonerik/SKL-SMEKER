<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'operator']);
        $role3 = Role::create(['name' => 'user']);

        $user = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@test.id',
            'password' => bcrypt('123456789'),
            'email_verified_at' => now(),
        ]);
        $user->assignRole($role1);

    }
}
