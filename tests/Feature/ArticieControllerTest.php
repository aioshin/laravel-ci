<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticieControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $response = $this->get(route('articles.index'));

        $response->assertStatus(400)->assertViewIs('articles.index');
    }

    //未ログイン状態によるテスト
    public function testGuestCreate()
    {
        $response = $this->get(route('articles.create'));
        $response->assertRedirect(route('login'));
    }
    
    //ログイン状態によるテスト
    public function testAuthCreate()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get(route('articles.create'));
        $response->assertStatus(200)->assertViewIs('articles.create');
    }
}
