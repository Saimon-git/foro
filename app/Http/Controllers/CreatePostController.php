<?php

namespace App\Http\Controllers;

use App\{Post,Category};
use Illuminate\Http\Request;

class CreatePostController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name','id')->toArray();
        return view('posts.create', ['categories' => $categories] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);
        $post = auth()->user()->createPost($request->all());

        return redirect($post->url);
    }
}
