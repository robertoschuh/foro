<?php

use App\Post;
use Carbon\Carbon;

class PostListTest extends FeatureTestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    function test_a_user_can_see_the_posts_list_and_go_to_the_details()
    {
        $post = $this->createPost([
            'title' => '¿Debo user Laravel 5.3 o 5.1 LTS?'
        ]);

      //  dd($post->url);
        $this->visit('/')
            ->seeInElement('h1', 'Posts')
            ->see($post->title)
            ->click($post->title)
            ->seePageIs($post->url);
    }

    function test_the_posts_are_paginated(){

        // Having
        $first = $this->createPost([
            'title' => 'Oldest post',
            'created_at' => Carbon::now()->subDay(2),
        ]);

        factory(Post::class)->times(15)->create([
            'created_at' => Carbon::now()->subDay(),
        ]);

        $last = $this->createPost([
            'title' => 'Newest post',
            'created_at' => Carbon::now(),
        ]);

    //    dd($last->title);
        $this->visit('/')
            ->see($last->title)
            ->dontSee($first->title)

            ->click('2')
            ->see($first->title)
            ->dontSee($last->title);

    }
}
