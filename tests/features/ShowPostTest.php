<?php

use App\Post;

class ShowPostTest extends TestCase
{
    function test_a_user_can_see_a_post_details()
    {
    	//Having 
        //(lo que tenemos)
    	
    	$user = $this->defaultUser([
    		'name' => 'Simon Montoya',
    	]);

    	$post = factory(Post::class)->make([
    		'title' => 'Este es el titulo del post',
    		'content' => 'Este es el contenido del post',
    	]);

    	$user->posts()->save($post);

    	//When
    	//(lo que sucede eventos)
    	$this->visit(route('posts.show',$post))
    	//Then 
        //(resultado)
    			->seeInElement('h1',$post->title)
    			->see($post->content)
    			->see($user->name);        
    }
}
