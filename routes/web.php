<?php

Route::get('/', 'JobController@index');

Route::get('/sitemap', 'JobController@xmlindex');

Route::get('/create_job', 'JobController@create')->middleware('auth');
Route::get('/job_info/{job}', 'JobController@show');
Route::get('/offers/{user}/{job}/edit', 'JobController@edit')->middleware('auth');
Route::get('/json_send', 'JobController@SendResult');
Route::post('/', 'JobController@store');
Route::delete('/offers/{user}/{job}/delete', 'JobController@destroy');
Route::patch('/job_info/{job}', 'JobController@update');
Route::get('/filter', 'JobController@filter');

Route::get('/profile/{user}', 'UserController@index')->middleware('auth');
Route::patch('/profile/{user}', 'UserController@update');

Route::get('/offers/{user}', 'RespondController@show')->middleware('auth');
Route::get('/responds/{user}', 'RespondController@index')->middleware('auth');
Route::get('/json_offer', 'RespondController@OfferJson');
Route::post('/offers/{user}', 'RespondController@store');
Route::patch('/responds/{user}', 'RespondController@update');

Route::patch('/rating', 'RatingController@update');
Route::get('/json_rating', 'RatingController@RatingJson');

Auth::routes(['verify' => true]);
Route::get('/', 'JobController@index')->name('home');

Route::get('/moderator_side/page_for_register_moderator', 'ModeratorController@register');
Route::post('/moderator_side/page_for_register_moderator', 'ModeratorController@create');
Route::get('/moderator_side/page_for_login_moderator', 'ModeratorController@login');
Route::post('/moderator_side/page_for_login_moderator', 'ModeratorController@check');
Route::get('/moderator_side/page_for_login_moderator/index', 'ModeratorController@index');
Route::patch('/moderator_side/page_for_login_moderator/index', 'ModeratorController@update');
Route::get('/moderator_side/job_json', 'ModeratorController@JobJson');