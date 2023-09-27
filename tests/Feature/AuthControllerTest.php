<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Inertia\Testing\AssertableInertia as Assert;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testLoginDisplaysLoginPage()
    {
        // Given
        // No user is authenticated

        // When
        $response = $this->get('/auth/login');

        // Then
        $response->assertInertia(fn (Assert $page) => $page
            ->component('UserLogin'));
    }

    public function testLoginDisplaysRegisterPage()
    {
        // Given
        // No user is authenticated

        // When
        $response = $this->get('/auth/register');

        // Then
        $response->assertInertia(fn (Assert $page) => $page
            ->component('UserRegister'));
    }

    public function testValidUserCanLogin()
    {
        // Given
        $user = User::factory()->create([
            'password' => bcrypt($password = 'password'),
        ]);

        // When
        $response = $this->post('/auth/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        // Then
        $response->assertRedirect('/');  // Redirect to dashboard
        $this->assertAuthenticatedAs($user);
    }

    public function testInvalidUserCannotLogin()
    {
        // Given
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);

        // When
        $response = $this->post('/auth/login', [
            'email' => $user->email,
            'password' => 'invalid-password',
        ]);

        // Then
        $response->assertStatus(200);  // OK
        $response->assertInertia(fn (Assert $page) => $page
            ->component('UserLogin')
            ->has('error'));
        $this->assertGuest();
    }


    public function testRegisterCreatesAndAuthenticatesUser()
    {
        // Given
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        // When
        $response = $this->post('/auth/register', $userData);

        // Then
        $response->assertRedirect('/auth/login');  // Redirect to login page
        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
