<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class ShowPostController extends Controller
{
    public function __invoke(Post $post, $slug)
    {
        if ($post->slug != $slug) {
            return redirect($post->url, 301);
        }

        return view('posts.show', [
		    'post' => $post,
		    'comments' => $post->latestComments()->paginate(15),
		]);
    }
}
