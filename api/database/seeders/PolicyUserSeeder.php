<?php

namespace Database\Seeders;

use App\Models\Policy;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PolicyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::whereIn('id', [2,3,4,5])->get();
        $policy = Policy::find([2,3]);
        foreach ($users as $user){

            $user->policies()->attach($policy);
        }
    }
}
