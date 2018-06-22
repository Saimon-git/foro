<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Post,Vote};
use App\Repositories\VoteRepository;

class VoteController extends Controller
{
    
    /**
     * Undocumented function
     *
     * @param Post $post
     * @return void
     */
    /* public function upvote(Post $post)
    {
        //dd('here');
        $post->upvote();
        
        return [
            'new_score' => $post->score
        ];

    }

    public function downvote(Post $post)
    {
        //dd($post);
        $post->downvote();

        return [
            'new_score' => $post->score
        ];

    }

    public function undoVote(Post $post)
    {
        $post->undoVote();

        return [
            'new_score' => $post->score
        ];

    } */
    public function upvote($module, $votable)
    {
        $votable->upvote();
        return [
            'new_score' => $votable->score,
        ];
    }
    public function downvote($module, $votable)
    {
        $votable->downvote();
        return [
            'new_score' => $votable->score,
        ];
    }
    public function undoVote($module, $votable)
    {
        $votable->undoVote();
        return [
            'new_score' => $votable->score,
        ];
    }
}
