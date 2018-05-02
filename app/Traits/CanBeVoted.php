<?php

namespace App\Traits;

use App\{Vote, User};

trait CanBeVoted
{

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function getCurrentVoteAttribute()
    {
        if(auth()->check())
        {
            return $this->getVoteFrom(auth()->user());
        }
        
    }

    public function getVoteFrom(User $user)
    {
        return $this->votes()
                    ->where('user_id',$user->id)
                    ->value('vote');//+1, -1, null                    
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
        $this->votes()
                ->where('user_id' , auth()->id())
                ->delete();

        $this->refreshPostScore();
    }

    protected function refreshPostScore()
    {
        $this->score = $this->votes()->sum('vote');
        $this->save();         
    }
}