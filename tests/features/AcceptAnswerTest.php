<?php

use App\{Comment, User};

class AcceptAnswerTest extends FeatureTestCase
{
    /**
     * Functional test, testing if a post author can accept a comments as the posts answer.
     *
     * @return void
     */
    function test_the_posts_author_can_accept_a_comment_as_the_posts_answer()
    {
        $comment = factory(Comment::class)->create([
            'comment' => 'test comment'
        ]);

        $this->actingAs($comment->post->user);

        $this->visit($comment->post->url)
            ->press('Submit answer');


        $this->seeInDatabase('posts', [
            'id' => $comment->post_id,
            'pending' => false,
            'answer_id' => $comment->id,
        ]);

        // After submit answer form.
        $this->seePageIs($comment->post->url)
            ->seeInElement('.answer', $comment->comment);

    }

    function test_non_posts_author_dont_see_the_accept_answer_button()
    {
        $comment = factory(Comment::class)->create([
            'comment' => 'test comment'
        ]);

        $this->actingAs(factory(User::class)->create());

        $this->visit($comment->post->url)
            ->dontSee('Submit answer');


    }

    function test_non_posts_author_cannot_accept_a_comment_as_the_posts_answer()
    {
        $comment = factory(Comment::class)->create([
            'comment' => 'test comment'
        ]);

        $this->actingAs(factory(User::class)->create());

        $this->post(route('comments.accept', $comment));

        $this->seeInDatabase('posts', [
            'id' => $comment->post_id,
            'pending' => true,

        ]);


    }


    function test_the_accept_button_is_hidden_when_the_comment_is_already_the_posts_answer()
    {
        $comment = factory(Comment::class)->create([
            'comment' => 'test comment'
        ]);

        $this->actingAs($comment->post->user);

        $comment->markAsAnswer();

        $this->visit($comment->post->url)
            ->dontSee('Submit answer');


    }
}
