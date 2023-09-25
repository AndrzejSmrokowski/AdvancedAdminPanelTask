<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexReturnsAllPosts()
    {
        // Given
        $posts = Post::factory()->count(3)->create();

        // When
        $response = $this->getJson('/api/posts');

        // Then
        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function testShowReturnsCorrectPost()
    {
        // Given
        $post = Post::factory()->create();

        // When
        $response = $this->getJson("/api/posts/{$post->id}");

        // Then
        $response->assertStatus(200)
            ->assertJson([
                'post' => [
                    'id' => $post->id,
                    'title' => $post->title,
                    'content' => $post->content,
                ]
            ]);
    }

    public function testShowReturns404ForNonExistentPost()
    {
        // When
        $response = $this->getJson('/api/posts/9999');

        // Then
        $response->assertStatus(404)
            ->assertJson(['message' => 'Post not found']);
    }
}
