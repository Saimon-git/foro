<?php

use App\User;
use App\Comment;
use App\Policies\CommentPolicy;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CommentPolicyTest extends TestCase
{
	use DatabaseTransactions;

    function test_the_posts_author_can_select_cooment_as_an_answer()
    {
    	$comment = factory(Comment::class)->create();

        $policy = new CommentPolicy;

        $this->assertTrue(
        	$policy->accept($comment->post->user, $comment));
    }

    function test_non_author_cannot_select_cooment_as_an_answer()
    {
    	$comment = factory(Comment::class)->create();

        $policy = new CommentPolicy;

        $this->assertFalse(
        	$policy->accept(factory(User::class)->create(), $comment));
    }
}
