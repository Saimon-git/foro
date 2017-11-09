<?php

use App\Comment;
use Carbon\Carbon;


class CommentsListTest extends FeaturesTestCase
{
    function test_a_user_can_see_the_comments_list()
    {
        //Having
        $post = $this->createPost([
        	'title' => 'Debo usar Laravel 5.3 o 5.1 LTS?',
        ]);

        $comment =factory(Comment::class)->create([
            'comment' => 'Este es el comentario mas antiguo',
            'post_id' => $post->id,
            'created_at' => Carbon::now()->subDays(2),
        ]);

        $this->visit($post->url)
        		->seeInElement('h1', $post->title)
        		->see('Este es el comentario mas antiguo');
    }

    function test_the_comments_are_paginated()
    {
        //Having
        $post = $this->createPost();

    	$first =factory(Comment::class)->create([
    		'comment' => 'Este es el comentario mas antiguo',
            'post_id' => $post->id,
            'created_at' => Carbon::now()->subDays(2),
    	]);

    	factory(Comment::class)->times(15)->create([
            'created_at' => Carbon::now()->subDay(),
            'post_id' => $post->id,
        ]);

    	$last =factory(Comment::class)->create([
    		'comment' => 'Este es el comentario mas nuevo',
            'post_id' => $post->id,
    	]);

        //When
        $this->visit($post->url)
                ->see($last->comment)
                ->dontSee($first->comment)                
                ->click('2')
                ->see($first->comment)
                ->dontSee($last->comment);
                
    }
}
