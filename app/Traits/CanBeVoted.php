<?php

namespace App\Traits;

use App\{Vote, User};

trait CanBeVoted
{

    public function getCurrentVoteAttribute()
    {
        return $this->getVoteFrom(auth()->user());
    }

    public function getVoteFrom(User $user)
    {
        return Vote::where('user_id',$user->id)->value('vote');//+1, -1, null
    }
    
    public function upvote()
    {

         $this->addVote(1);
    }

    public function downvote()
    {
         $this->addVote(-1);
    }

    protected function addVote($amount)
    {
        Vote::updateOrCreate(
            ['post_id' => $this->id,'user_id' => auth()->id()],
            ['vote' => $amount]
        ); 
        
         $this->refreshPostScore();
    }

    public function undoVote()
    {
        Vote::where([
            'post_id' => $this->id, 
            'user_id' => auth()->id()
        ])->delete(); 
        
         $this->refreshPostScore();
    }

    protected function refreshPostScore()
    {
        $this->score = Vote::where(['post_id' => $this->id])->sum('vote');
        $this->save();         
    }
}