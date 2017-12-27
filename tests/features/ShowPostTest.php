<?php


class ShowPostTest extends FeaturesTestCase
{
    function test_a_user_can_see_a_post_details()
    {
    	//Having 
        //(lo que tenemos)
    	
    	$user = $this->defaultUser([
            'first_name' => 'Simon',
            'last_name' => 'Montoya',
    	]);

    	$post = $this->createPost([
    		'title' => 'Este es el titulo del post',
    		'content' => 'Este es el contenido del post',
            'user_id' => $user->id,
    	]);

    	//$user->posts()->save($post); comentado por refactoring en model factory

    	//When
    	//(lo que sucede eventos)
    	$this->visit($post->url)
    	//Then 
        //(resultado)
    			->seeInElement('h1',$post->title)
    			->see($post->content)
    			->see('Simon Montoya');        
    }

    function test_old_url_are_redirected()
    {
        //Having 
        //(lo que tenemos)
        
        //$user = $this->defaultUser(); comentado por refactoring en model factory

        $post = $this->createPost([
            'title' => 'Titulo viejo',            
        ]);

        //$user->posts()->save($post); comentado por refactoring en model factory

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
