<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AuthControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test user registration.
     *
     * @return void
     */
    public function testUserRegistration()
    {
        $role = Role::factory()->create(['name'=>'User', 'slug' => 'user']);

        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password',
        ];

        $response = $this->postJson('/api/register', $data);

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'User Created Successfully',
                'user' => [
                    'name' => $data['name'],
                    'email' => $data['email'],
                ],
            ]);

        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
            'email' => $data['email'],
            'role_id' => $role->id,
        ]);
    }

    /**
     * Test user login.
     *
     * @return void
     */
    public function testUserLogin()
    {
        $password = 'password';
        $role = Role::factory()->create(['name'=>'User', 'slug' => 'user']);
        $user = User::factory()->create([
            'password' => Hash::make($password),
            'role_id'=>$role->id
        ]);

        $data = [
            'email' => $user->email,
            'password' => $password,
        ];

        $response = $this->postJson('/api/login', $data);

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                ],
            ]);
    }
}
