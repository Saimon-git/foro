<?php


class WriteCommentTest extends FeaturesTestCase
{
    function test_a_user_can_write_a_comment()
    {
        //Having
        
        $post = $this->createPost();
        $user = $this->defaultUser();

        //When
        
        $this->actingAs($user)
        		->visit($post->url)
        		->type('Un comentario', 'comment')
        		->press('Publicar comentario');

        //Then
        
        $this->seeInDatabase('comments',[
        		'comment' => 'Un comentario',
        		'user_id' => $user->id,
        		'post_id' => $post->id,
        ]);

        $this->seePageIs($post->url);        
    }

    function test_creating_a_comment_require_authentication()
    {
    	//Having
    	$post = $this->createPost();
        //When
        $this->visit($post->url)
        		->press('Publicar comentario');

        //Then
        $this->seePageIs(route('login'));
    }

    function test_create_comment_form_validation()
    {

        //Having
        
        $post = $this->createPost();
        $user = $this->defaultUser();

        //When
        
        $this->actingAs($user)
        		->visit($post->url)
        		->type('', 'comment')
        		->press('Publicar comentario')
		//Then        		
        		->seePageIs($post->url)
                ->see('El campo comentario es obligatorio');                
    }
}
