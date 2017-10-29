<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostIntegrationTest extends TestCase
{
	use DatabaseTransactions;

    function test_a_slug_generated_and_saved_to_the_database()
    {
    	//$user = $this->defaultUser(); comentado por mejoras en el factory

        $post = $this->createPost([
        	'title' => 'Como instalar Laravel',
        ]);

        //$user->posts()->save($post); comentado por mejoras en el factory

        $this->seeInDatabase('posts', [
        	'slug' =>  'como-instalar-laravel',
        ]);

        //$this->assertSame('como-instalar-laravel', $post->fresh()->slug);
    }
}
