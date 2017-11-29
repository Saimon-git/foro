<?php

use App\User;


class CommentsSupportMarkdown extends FeaturesTestCase
{
    function test_the_comment_content_support_markdown()
    {
        $importantComment = 'Un comentario muy importante';

        $post = $this->createPost();
        $user = factory(User::class)->create();
        //dd($user);

        $this->actingAs($user)
                ->visit($post->url)
                ->type("La primera parte del comentario. **$importantComment**. la ultima parte del comentario", 'comment')
                ->press('Publicar comentario');

        $this->visit($post->url)
        		->seeInElement('strong', $importantComment);
    }

    /*function test_the_code_in_the_comment_is_escaped()
    {
        $xssAttack = "<script>alert('Malisius JS!')</script>";

        $post = $this->createPost([
            'content' => "`$xssAttack`. Texto normal."
        ]);

        $this->visit($post->url)
                ->dontSee($xssAttack)
                ->seeText('Texto normal')
                ->seeText($xssAttack);
    }

    function test_xss_attack_comments()
    {
    	$xssAttack = "<script>alert('Malisius JS!')</script>";

    	$post = $this->createPost([
    		'content' => "$xssAttack. Texto normal."
    	]);

    	$this->visit($post->url)
                //->dump()
    			->dontSee($xssAttack)
                ->seeText('Texto normal')
                ->seeText($xssAttack);//todo: fix this!
    }

    function test_xss_attack_with_html_comments()
    {
        $xssAttack = "<img src='img1.jpg'>";

        $post = $this->createPost([
            'content' => "$xssAttack. Text normal."
        ]);

        $this->visit($post->url)
                ->dontSee($xssAttack);
    }*/
}
