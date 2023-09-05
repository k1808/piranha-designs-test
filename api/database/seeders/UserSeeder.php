<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::where('slug', 'admin')->first();
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@i.ua',
            'role_id'=>$admin->id
        ]);
        \App\Models\User::factory(5)->create();

    }
}
