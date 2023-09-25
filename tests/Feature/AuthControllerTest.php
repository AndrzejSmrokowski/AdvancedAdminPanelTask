<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testLoginWithValidCredentialsShouldReturn200(): void
    {
        // Given
        $user = \App\Models\User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // When
        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        // Then
        self::assertEquals(200, $response->status());
        self::assertEquals('Successfully logged in', $response->json()['message']);

        // Check if the cookie exists
        $cookies = $response->headers->getCookies();
        $tokenCookieExists = false;
        foreach ($cookies as $cookie) {
            if ($cookie->getName() === 'jwt') {
                $tokenCookieExists = true;
                break;
            }
        }
        self::assertTrue($tokenCookieExists, 'JWT cookie not found in response');
    }

    public function testLoginWithInvalidCredentialsShouldReturn401(): void
    {
        // Given
        // No user is created

        // When
        $response = $this->postJson('/api/login', [
            'email' => 'wrong@example.com',
            'password' => 'wrongpassword',
        ]);

        // Then
        $response->assertStatus(401);
        $response->assertJson(['message' => 'Invalid email or password']);
    }

    public function testRegisterWithValidDataShouldReturn201(): void
    {
        // Given
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        // When
        $response = $this->postJson('/api/register', $userData);

        // Then
        self::assertEquals(201, $response->status());
        self::assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        // Check if the cookie exists
        $cookies = $response->headers->getCookies();
        $tokenCookieExists = false;
        foreach ($cookies as $cookie) {
            if ($cookie->getName() === 'jwt') {
                $tokenCookieExists = true;
                break;
            }
        }
        self::assertTrue($tokenCookieExists, 'JWT cookie not found in response');
    }

}
