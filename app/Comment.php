<?php

namespace App;

use App\Post;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment','post_id'];

    
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function post()
    {
    	return $this->belongsTo(Post::class);
    }

    public function markAsAnswer()
    {

    	$this->post->pending = false;
    	$this->post->answer_id = $this->id;

    	$this->post->save();
    }

    public function getanswerAttribute()
    {
        return $this->id === $this->post->answer_id;
    }
}