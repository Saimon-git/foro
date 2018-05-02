<?php 
//Rotes that require authentication = Estas rutas requieren estar autenticado.


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
Route::post('posts/{post}/upvote', [
  'uses' => 'VotePostController@upvote'
])->where('post', '\d+');

Route::post('posts/{post}/downvote', [
  'uses' => 'VotePostController@downvote'
])->where('post', '\d+');

Route::delete('posts/{post}/vote', [
  'uses' => 'VotePostController@undoVote'
])->where('post', '\d+');

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