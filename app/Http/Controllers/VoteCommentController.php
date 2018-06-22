<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Post,Vote,Comment};
use App\Repositories\VoteRepository;

class VoteCommentController extends Controller
{
    
    /**
     * Undocumented function
     *
     * @param Comment $post
     * @return void
     */
    public function upvote(Comment $comment)
    {
        //dd('here');
        $comment->upvote();
        
        return [
            'new_score' => $comment->score
        ];

    }

    public function downvote(Comment $comment)
    {
        //dd($comment);
        $comment->downvote();

        return [
            'new_score' => $comment->score
        ];

    }

    public function undoVote(Comment $comment)
    {
        $comment->undoVote();

        return [
            'new_score' => $comment->score
        ];

    }
}
