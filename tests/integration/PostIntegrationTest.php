<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostIntegrationTest extends TestCase
{

    use DatabaseTransactions;

    public function test_a_slug_is_generate_and_saved_to_the_database()
    {


        $post = $this->createPost([
            'title' => 'Como instalar Laravel',
        ]);


        $this->assertSame('como-instalar-laravel', $post->slug);

        /*

        $this->seeInDatabase('posts', [
           'slug' => 'como-instalar-laravel'
        ]);

         */

    }

    // Exercise
    public function test_post_url_is_correct(){

        //$user = $this->defaultUser();

        $post = $this->createPost([
            'title' => 'Como instalar Laravel',
        ]);


        //$user->posts()->save($post);

        //dd( $post->url);
        $this->assertSame('http://foro.test/posts/' . $post->id . '-como-instalar-laravel', $post->url);

    }
}
