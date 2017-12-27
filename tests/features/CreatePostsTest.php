<?php 

use App\Post;


class CreatePostsTest extends FeaturesTestCase
{
    
    function test_a_user_create_a_post()
    {
    	
        //Having 
        //(lo que tenemos)
        $user = $this->defaultUser();
        $title = 'Esta es una pregunta';
        $content = 'Este es el contenido';

        $this->actingAs($user);
    	
        //When
        //(lo que sucede eventos)
        $this->visit(route('posts.create'))
    			->type($title, 'title')
    			->type($content, 'content')
    			->press('Publicar');

        //Then 
        //(resultado)
    	$this->seeInDatabase('posts',[
    		'title' => $title,
    		'content' => $content,
    		'pending' => true,
            'user_id' =>$user->id,
            'slug' => 'esta-es-una-pregunta',
    	]);

        $post = Post::first();

        //Test the author is subscribed automatically tho the post
        $this->seeInDatabase('subscriptions',[
            'user_id' => $user->id,
            'post_id' => $post->id
        ]);


        //Test a user is redirected to the post details after creating it.
        //(Probar a un usuario se redirige a los detalles de la publicación después de crearlo.)
        $this->seePageIs($post->url);        
    }

    /*function test_a_guest_user_tries_to_create_a_post()
    {
        
        //Having 
        //(lo que tenemos)
        $user = $this->defaultUser();
        $title = 'Esta es una pregunta';
        $content = 'Este es el contenido';

        //$this->actingAs($user);
        
        //When
        //(lo que sucede eventos)
        $this->visit(route('posts.create'))
                ->type($title, 'title')
                ->type($content, 'content')
                ->press('Publicar');

        //Then 
        //(resultado)
        $this->seeInDatabase('posts',[
            'title' => $title,
            'content' => $content,
            'pending' => true,
            'user_id' =>$user->id,
        ]);


        //Test a user is redirected to the post details after creating it.
        //(Probar a un usuario se redirige a los detalles de la publicación después de crearlo.)
        $this->see('h1', $title);        
    }*/

    function test_creating_a_post_require_authentication()
    {
        //When
        $this->visit(route('posts.create'));

        //Then
        $this->seePageIs(route('token'));
    }

    function test_create_post_form_validation()
    {

        $user = $this->defaultUser();
        //Having
        $this->actingAs($user)
                ->visit(route('posts.create'))
                ->press('Publicar')
                ->seePageIs(route('posts.create'))
                ->seeErrors([
                    'title' => 'El campo título es obligatorio',
                    'content' => 'El campo contenido es obligatorio'
                ]);                
    }
}