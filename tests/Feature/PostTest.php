<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;
use App\Models\Comment;

class PostTest extends TestCase
{   
    use RefreshDatabase;

    // public function setUp(): void {
    //     //Ham setUp chay trc ham Test    
    // }
    public function tearDown(): void {
        //Ham tearDown chay sau ham Test
        Post::truncate();
    }
    public function testNoPostWhenNothingInDB()
    {
        $response = $this->get('/posts');
        $response->assertSeeText('Not found posts');
        // $response->assertStatus(200);
    }

    public function testSee1BPostWhenThereIs1() 
    {
        // Arrange
        $post = $this->createDummyPost();
        // $post = new Post();
        // $post->title = 'New title';
        // $post->content = 'Content of the post';
        // $post->save();

        // Act
        $response = $this->get('/posts');

        // Assert
        $response->assertSeeText('New title');

        $this->assertDatabaseHas('posts', [
            'title' => 'New title'
        ]);


    }


    
    public function testSee1PostWhenThereIs1WithNoComments() 
    {
        // Arrange
        $post = $this->createDummyPost();

        // Act
        $response = $this->get('/posts');

        // Assert
        $response->assertSeeText('New title');
        $response->assertSeeText('No comments yet!');

        $this->assertDatabaseHas('posts', [
            'title' => 'New title'
        ]);
    }

    public function testSee1PostWithComments()
    {

        // Arrange
        $post = $this->createDummyPost();

        Comment::factory()->count(4)->create([
            'post_id' => $post->id
        ]);

        // Act
        $response = $this->get('/posts');

        // Assert
        $response->assertSeeText('4 comments');
    }

    public function testStoreValid() {

        $params = [
            'title' => 'valid title',
            'content' =>  'At least 10 characters'
        ];

        $this->actingAs($this->user())
            ->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'The post created susscess!');
    }

    public function testStoreFail() {
        $params = [
            'title' => 'x',
            'content' => 'x',
        ];

        $this->actingAs($this->user())
            ->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('errors');
        
        $messages = session('errors') -> getMessages();
     
        $this->assertEquals($messages['title'][0], 'The title must be at least 5 characters.');
        $this->assertEquals($messages['content'][0], 'The content must be at least 10 characters.');
    }

    public function testUpdateValid() {
        $post = $this->createDummyPost();

        $this->assertDatabaseHas('posts', $post->toArray());

        $params = [
            'title' => 'A new named title',
            'content' => 'Content was changed'
        ];

        $this->actingAs($this->user())
            ->PUT("/posts/{$post->id}", $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Post was updated!');
        $this->assertDatabaseMissing('posts', $post->toArray());
        $this->assertDatabaseHas('posts', [
            'title' => 'A new named title'
        ]);
    }


    public function testDelete() {
        $post = $this->createDummyPost();
        $this->assertDatabaseHas('posts', $post->toArray());

        $this->actingAs($this->user())
            ->delete("/posts/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Post was deleted!');
        $this->assertDatabaseMissing('posts', $post->toArray());
        // $this->assertSoftDeleted('post', $post->toArray());
    }

    private function createDummyPost(): Post
    {
        $post = new Post();
        $post->title = 'New title';
        $post->content = 'Content of the post';
        $post->save();

        return $post;

        // Post::factory() ->count(1) 
        //     ->state([
        //         'title' => 'New title', 
        //         'content' => 'Content of the post'
        //     ])
        //     ->create();

    }
}
