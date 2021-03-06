<?php

namespace App;

use App\User;
use App\Vote;
use App\Comment;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use GrahamCampbell\Markdown\Facades\Markdown;
use App\Traits\CanBeVoted;

class Post extends Model
{
    use CanBeVoted;
    protected $fillable = ['title','content','category_id'];

    protected $casts = [
        'pending' => 'boolean',
        'score' => 'integer',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function subscribers()
    {
        return $this->belongsToMany(User::class,'subscriptions');
    }

    public function setTitleAttribute($value)
    {
    	$this->attributes['title'] = $value;

    	$this->attributes['slug'] = Str::slug($value);
    }

    public function getUrlAttribute()
    {
        return route('posts.show',[$this->id,$this->slug]);
    }

    public function latestComments()
    {
        return $this->comments()->orderBy('created_at','DESC');
    }

    public function scopeCategory($query ,Category $category = null)
    {
        if(optional($category)->exists)
        {
            $query->where('category_id', $category->id);
        }
    }

    public function scopePending($query)
    {
        $query->where('pending',true);
    }

    public function scopeByUser($query, User $user)
    {
        $query->where('user_id',$user->id);
    }

    public function scopeCompleted($query)
    {
        $query->where('pending',false);
    }

    public function getSafeHtmlContentAttribute()
    {
        return Markdown::convertToHtml(e($this->content));
    }

    
}
