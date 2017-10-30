<?php

namespace App;

use App\Post;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment','post_id'];

    protected $casts = ['answer' => 'boolean'];

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
    	$this->post->comments()->where('answer',true)->update(['answer' => false]);
    	
    	$this->answer = true;

    	$this->save();

    	$this->post->pending = false;

    	$this->post->save();
    }
}
