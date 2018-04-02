<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShowPostTest extends FeatureTestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    function test_a_user_can_see_the_post_details()
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

        //dd(route('posts.show', $post));

        // When
      //  $this->visit(route('posts.show', [$post->id, $post->slug])) //posts/19902
        $this->visit($post->url) //posts/19902
            ->seeInElement('h1', $post->title)
            ->see($post->content)
            ->see($user->name);
    }

    function test_old_urls_are_redirected(){

        // Having
        $user = $this->defaultUser();

        $post = factory(\App\Post::class)->make([ // using make instead create, because make creates the model, but it does not save into the db.
            'title' => 'Old title',
        ]);

        $user->posts()->save($post);

        $url = $post->url;

        $post->update(['title' => 'New title']);

        $this->visit($url)
            ->seePageIs($post->url);

    }

    /*
    function test_post_url_with_wrong_slugs_still_work(){

        // Having
        $user = $this->defaultUser();

        $post = factory(\App\Post::class)->make([ // using make instead create, because make creates the model, but it does not save into the db.
            'title' => 'Old title',
        ]);

        $user->posts()->save($post);

        $url = $post->url;

        $post->update(['title' => 'New title']);


      //  $this->get($url)
      //      ->assertResponseStatus(404);



        $this->visit($url)
            ->assertResponseOk()
            ->see('New title');

    }
    */

}
