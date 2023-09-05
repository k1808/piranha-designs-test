<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $managePolicy = Permission::where('slug', 'manage-policy')->get();
        $admin = new Role();
        $admin->name = 'Admin';
        $admin->slug = 'admin';
        $admin->save();
        $admin->permissions()->attach($managePolicy);

        $user = new Role();
        $user->name = 'User';
        $user->slug = 'user';
        $user->save();
    }
}
