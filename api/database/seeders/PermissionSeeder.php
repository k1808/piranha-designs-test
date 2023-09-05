<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $managePolicy = new Permission();
        $managePolicy->name = 'Manage policy';
        $managePolicy->slug = 'manage-policy';
        $managePolicy->save();

    }
}
