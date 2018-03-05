<?php

Route::get('/', 'PostController@get');

// Post routes
Route::get('/posts', 'PostController@get')->name('posts');
Route::get('/post/create', 'PostController@create')->name('createPost');
Route::get('post/{id}', 'PostController@show')->name('showPost');
Route::get('post/{id}/edit', 'PostController@edit')->name('editPost');
Route::post('post/create', 'PostController@store')->name('storePost');
Route::post('post/{post}/edit', 'PostController@update')->name('updatePost');
Route::post('post/{post}', 'PostController@destroy')->name('deletePost');


// Category routes
Route::get('/categories', 'CategoryController@get')->name('categories');
Route::get('/category/create', function () {
    return view('category.create');
})->name('createCategory');
Route::get('category/{id}', 'CategoryController@show')->name('showCategory');
Route::get('category/{category}/edit', 'CategoryController@edit')->name('editCategory');
Route::post('category/create', 'CategoryController@store')->name('storeCategory');
Route::post('category/{category}/edit', 'CategoryController@update')->name('updateCategory');
Route::post('category/{category}', 'CategoryController@destroy')->name('deleteCategory');

// Feedbacks routes
Route::post('category/{category}/feedback', 'CategoryController@addFeedback')->name('addToCategory');
Route::post('post/{post}/feedback', 'PostController@addFeedback')->name('addToPost');