<?php


class SubscribeToPostsTest extends FeaturesTestCase
{
    function test_a_user_can_subscribe_to_a_post()
    {
    	//Having
        $post = $this->createPost();
        $user = $this->defaultUser();

        $this->actingAs($user);

        //When
        $this->visit($post->url)
        		->press('Suscribirse al Post');

        //Then
        $this->seeInDatabase('subscriptions',[
        	'user_id' => $user->id,
        	'post_id' => $post->id
        ]);

        $this->seePageIs($post->url)
        		->dontSee('Suscribirse al Post');
    }

    function test_a_user_can_unsubscribe_from_a_post()
    {
    	//Having
        $post = $this->createPost();
        $user = $this->defaultUser();

        $user->subscribeTo($post);
        $this->actingAs($user);

        //When
        $this->visit($post->url)
        		->dontSee('Suscribirse al Post')
        		->press('Desuscribirse del Post');

        //Then
        $this->dontSeeInDatabase('subscriptions',[
        	'user_id' => $user->id,
        	'post_id' => $post->id
        ]);

        $this->seePageIs($post->url);
    }
}
