<?php

use App\Comment;

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
}
