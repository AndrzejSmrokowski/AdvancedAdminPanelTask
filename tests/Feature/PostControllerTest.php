<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->be($this->user);  // albo $this->actingAs($this->user);
    }

    public function testIndexReturnsAllPosts()
    {
        // Given
        $posts = Post::factory()->count(3)->create();

        // When
        $response = $this->get('/posts');

        // Then
        $response->assertInertia(fn (Assert $page) => $page
            ->component('Posts/Index')
            ->has('posts', 3)
        );
    }

    public function testShowReturnsCorrectPost()
    {
        // Given
        $post = Post::factory()->create();

        // When
        $response = $this->get("/posts/{$post->id}");

        // Then
        $response->assertInertia(fn (Assert $page) => $page
            ->component('Posts/Show')
        );
    }

    public function testShowReturns404ForNonExistentPost()
    {
        // Given
        // No post is created

        // When
        $response = $this->get('/posts/9999');

        // Then
        $response->assertInertia(fn (Assert $page) => $page
            ->component('Posts/NotFound')
        );
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
        $response = $this->post('/posts', $postData);

        // Then
        $this->assertDatabaseHas('posts', [
            'title' => 'Test Title',
            'content' => 'Test Content',
        ]);
    }

    public function testUpdatePost()
    {
        // Given
        $post = Post::factory()->create();
        $updatedData = [
            'title' => 'Updated Title',
            'content' => 'Updated Content',
        ];

        // When
        $response = $this->put("/posts/{$post->id}", $updatedData);

        // Then
        $response->assertRedirect("/posts/{$post->id}");
        $this->assertDatabaseHas('posts', $updatedData);
    }

    public function testDestroyPost()
    {
        // Given
        $post = Post::factory()->create();

        // When
        $response = $this->delete("/posts/{$post->id}");

        // Then
        $response->assertRedirect('/posts');
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }
}
