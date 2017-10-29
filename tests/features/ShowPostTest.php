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
    	$this->visit($post->url)
    	//Then 
        //(resultado)
    			->seeInElement('h1',$post->title)
    			->see($post->content)
    			->see($user->name);        
    }

    function test_old_url_are_redirected()
    {
        //Having 
        //(lo que tenemos)
        
        $user = $this->defaultUser();

        $post = factory(Post::class)->make([
            'title' => 'Titulo viejo',            
        ]);

        $user->posts()->save($post);

        $url = $post->url;

        $post->update(['title' => 'Titulo nuevo']);

        //When
        $this->visit($url)
                ->seePageIs($post->url);
    }


    /*function test_post_url_with_wrong_slugs_still_work()
    {
        //Having 
        //(lo que tenemos)
        
        $user = $this->defaultUser();

        $post = factory(Post::class)->make([
            'title' => 'Titulo viejo',            
        ]);

        $user->posts()->save($post);

        $url = $post->url;

        $post->update(['title' => 'Titulo nuevo']);

        //dd($url);
        //When
        $this->visit($url)
                ->assertResponseStatus(200)
                ->see('Titulo nuevo');
    }*/
}
