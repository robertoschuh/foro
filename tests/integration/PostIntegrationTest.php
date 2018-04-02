<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Post;

class PostIntegrationTest extends TestCase
{

    use DatabaseTransactions;

    public function test_a_slug_is_generate_and_saved_to_the_database()
    {

        $user = $this->defaultUser();

        $post = factory(Post::Class)->make([
            'title' => 'Como instalar Laravel',
        ]);


        $user->posts()->save($post);

        $this->assertSame('como-instalar-laravel', $post->slug);

        /*

        $this->seeInDatabase('posts', [
           'slug' => 'como-instalar-laravel'
        ]);

         */

    }
}