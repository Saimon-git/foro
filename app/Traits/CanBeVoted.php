<?php

namespace App\Traits;

use App\{Vote, User};

trait CanBeVoted
{

    public function votes()
    {
        return $this->morphMany(Vote::class,'votable');
    }

    public function userVote()
    {
        return $this->morphOne(Vote::class, 'votable')
                    ->where('user_id',auth()->id())
                    ->withDefault();
    }

    public function getCurrentVoteAttribute()
    {
        if(auth()->check())
        {
            return $this->userVote->vote;
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
       // dd('here');
         $this->addVote(1);
    }

    public function downvote()
    {
         $this->addVote(-1);
    }

    protected function addVote($amount)
    {
        $this->votes()->updateOrCreate(//votable_id, votable_type
            ['user_id' => auth()->id()],
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