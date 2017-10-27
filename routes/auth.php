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