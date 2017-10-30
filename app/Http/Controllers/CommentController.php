<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
    	
    	$this->validate($request, [
    	    'comment' => 'required'    	    
    	]);
    	auth()->user()->comment($post,$request->comment);

    	return redirect($post->url);
    }
}
