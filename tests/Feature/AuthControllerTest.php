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
        self::assertEquals(['message' => 'Successfully logged in'], $response->json());
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
        self::assertEquals(401, $response->status());
        self::assertEquals(['message' => 'Invalid email or password'], $response->json());
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
        self::assertTrue((bool)$this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]));
    }
}
