<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    public function testHomePageIsWorkingCorrectly()
    {
        $response = $this->get('/');
        $response->assertSeeText('Welcome to Laravel!');
        $response->assertSeeText('This is the content of the main page!');
        // $response->assertStatus(200);
    }
}
