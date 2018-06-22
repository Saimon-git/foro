<?php 
//Rotes that require authentication = Estas rutas requieren estar autenticado.
Route::post('logout', 'Auth\LoginController@logout');

//Posts = Publicaciones
Route::get('posts/create', [
  'uses' => 'CreatePostController@create',
  'as' => 'posts.create'
]);

Route::post('posts/create', [
  'uses' => 'CreatePostController@store',
  'as' => 'posts.store'
]);

//Votes = votos

// Votes
Route::pattern('module', '[a-z]+');
Route::bind('votable', function ($votableId, $route) {
    $modules = [
        'posts' => 'App\Post',
        'comments' => 'App\Comment',
    ];
    abort_unless($model = $modules[$route->parameter('module')] ?? null, 404);
    return $model::findOrFail($votableId);
});

Route::post('{module}/{votable}/upvote', [
  'uses' => 'VoteController@upvote'
])->where('post', '\d+');

Route::post('{module}/{votable}/downvote', [
  'uses' => 'VoteController@downvote'
])->where('post', '\d+');

Route::delete('{module}/{votable}/vote', [
  'uses' => 'VoteController@undoVote'
])->where('post', '\d+');

/* Route::post('comments/{comment}/upvote', [
  'uses' => 'VoteCommentController@upvote'
])->where('post', '\d+');

Route::post('comments/{comment}/downvote', [
  'uses' => 'VoteCommentController@downvote'
])->where('post', '\d+');

Route::delete('comments/{comment}/vote', [
  'uses' => 'VoteCommentController@undoVote'
])->where('post', '\d+'); */

//Comments = Comentarios
Route::post('posts/{post}/comment', [
  'uses' => 'CommentController@store',
  'as' => 'comments.store'
]);

Route::post('comments/{comment}/accept', [
  'uses' => 'CommentController@accept',
  'as' => 'comments.accept'
]);

//Subscriptions = Subscribciones
Route::post('posts/{post}/subscribe', [
  'uses' => 'SubscriptionController@subscribe',
  'as' => 'posts.subscribe'
]);

Route::delete('posts/{post}/unsubscribe', [
  'uses' => 'SubscriptionController@unsubscribe',
  'as' => 'posts.unsubscribe'
]);

Route::get('mis-posts/{category?}', [
  'uses' => 'ListPostController',
  'as' => 'posts.mine'
]);