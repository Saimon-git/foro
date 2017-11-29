<?php

use App\User;
use App\Notifications\PostCommented;
use Illuminate\Support\Facades\Notification;


class NotifyUsersTest extends FeaturesTestCase
{
    function test_the_suscribers_recive_a_notification_when_post_is_commented()
    {
    	Notification::fake();
        $post = $this->createPost();

        $subscriber = factory(User::class)->create();

        $subscriber->subscribeTo($post);

        $writer = factory(User::class)->create();

        $comment = $writer->comment($post, 'Un comentario cualquira');

        Notification::assertSentTo(
        $subscriber, PostCommented::class, function ($notification) use ($comment)
        {
        	return $notification->comment->id == $comment->id;
        });

        //The author  of the comment should not be notified even if he or she is a subscriber.
        Notification::assertNotSentTo($writer, PostCommented::class);
    }
}
