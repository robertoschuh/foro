<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShowPostTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_user_can_see_the_post_details()
    {
        // Having
        $user = $this->defaultUser([
           'name' => 'papixula',
        ]);

        $post = factory(\App\Post::class)->make([ // using make instead create, because make creates the model, but it does not save into the db.
            'title' => 'Como viajar por el mundo',
            'content' => 'contenido para como viajar por el mundo'
        ]);

        $user->posts()->save($post);

        // When
        $this->visit(route('posts.show', $post)) //posts/19902
            ->seeInElement('h1', $post->title)
            ->see($post->content)
            ->see($user->name);
    }
}
