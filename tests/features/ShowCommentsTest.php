<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\{Comment, Post};
use Carbon\Carbon;

class ShowCommentsTest extends FeatureTestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    function test_comments_showed_and_paginated_in_a_post_view ()
    {
        $post = factory(Post::class)->create();

        $firstComment = factory(Comment::class)->create([
            'comment' => 'first comment',
            'post_id' => $post->id,
        ]);

        $comments = factory(Comment::class)->times(50)->create([
            'comment' => 'middle comments',
            'post_id' => $post->id,
        ]);

        $lastComment = factory(Comment::class)->create([
            'comment' => 'last comment',
            'post_id' => $post->id,
        ]);

        $this->visit($post->url)
            ->seeInElement('.author', $firstComment->user->name);
    }

/*
    function test_the_comments_are_paginated(){

        $post = factory(Post::class)->create();

        $firstComment = factory(Comment::class)->create([
            'comment' => 'first comment',
            'post_id' => $post->id,
            'created_at' => Carbon::now()->subDay(2),
        ]);

        $comments = factory(Comment::class)->times(15)->create([
            'comment' => 'middle comments',
            'post_id' => $post->id,
            'created_at' => Carbon::now()->subDay(),
        ]);

        $lastComment = factory(Comment::class)->create([
            'comment' => 'last comment',
            'post_id' => $post->id,
            'created_at' => Carbon::now(),
        ]);

        $this->visit($post->url)
            ->see($firstComment->comment)
            ->dontSee($lastComment->comment)
            ->click('2')
            ->see($lastComment->comment)
            ->dontSee($firstComment->comment);

    }
*/
}
