<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
     public function test_can_create_user()
     {
         $user = User::factory()->make();

         $userData = [
             'name' => $user->name,
             'email' => $user->email,
             'password' => $user->password,
             'c_password' => $user->password
         ];

         $this->post(route('user.create'), $userData)->assertStatus(201);
     }

     public function test_can_login_user()
     {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'i-love-laravel'),
        ]);

        $credintial = [
            'email' => $user->email,
            'password' => $password
        ];

         $this->post(route('user.login'), $credintial)->assertStatus(200);
     }
}
