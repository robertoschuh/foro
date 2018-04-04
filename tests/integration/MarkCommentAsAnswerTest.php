<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Comment;
class MarkCommentAsAnswerTest extends TestCase
{

    use DatabaseTransactions;

    function test_a_post_can_be_answered()
    {
        $post = $this->createPost();
        $user = $this->defaultUser();

        $comment = factory(Comment::class)->create([
            'post_id' => $post->id,
            'user_id' => $user->id
        ]);

        $comment->markAsAnswer();

        // fresh get a "fresh" model information from the db.

        $this->assertTrue($comment->fresh()->answer);

        $this->assertFalse($post->fresh()->pending);
    }

    function test_a_post_can_only_have_one_answer()
    {
        $post = $this->createPost();

        $comments = factory(Comment::class)->times(2)->create([
            'post_id' => $post->id
        ]);

        $comments->first()->markAsAnswer();
        $comments->last()->markAsAnswer();


        // fresh get a "fresh" model information from the db.
        // Check mutator getAnswerAttribute.
        $this->assertFalse($comments->first()->fresh()->answer);
        $this->assertTrue($comments->last()->fresh()->answer);
    }
}
