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
        // Given
        // No post is created

        // When
        $response = $this->getJson('/api/posts/9999');

        // Then
        $response->assertStatus(404)
            ->assertJson(['message' => 'Post not found']);
    }

    public function testStorePost()
    {
        // Given
        $postData = [
            'title' => 'Test Title',
            'content' => 'Test Content',
            'tags' => ['tag1', 'tag2']
        ];

        // When
        $response = $this->postJson('/api/posts', $postData);

        // Then
        $response->assertJson([
            'message' => 'post successfully created',
            'data' => [
                'title' => 'Test Title',
                'content' => 'Test Content',
                'tags' => ['tag1', 'tag2'],
            ]
        ]);
    }

    public function testUpdatePost()
    {
        // Given
        $post = Post::factory()->create();

        $updatedData = [
            'title' => 'Updated Title',
            'content' => 'Updated Content',
            'tags' => ['newTag1', 'newTag2']
        ];

        // When
        $response = $this->putJson("/api/posts/{$post->id}", $updatedData);

        // Then
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Post successfully updated',
                'data' => $updatedData
            ]);
    }

    public function testDestroyPost()
    {
        // Given
        $post = Post::factory()->create();

        // When
        $response = $this->deleteJson("/api/posts/{$post->id}");

        // Then
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Post successfully deleted'
            ]);
    }
}
