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