<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');

Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');
Route::post('/folders/create', 'FolderController@create');


Route::get('/tasks', 'TaskController@all')->name('tasks.all');

Route::get('/folders/{folder}/tasks', 'TaskController@folder')->name('tasks.index');

Route::get('/folders/{folder}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
Route::post('/folders/{folder}/tasks/create', 'TaskController@create');

Route::get('/folders/{folder}/tasks/{task}/edit', 'TaskController@showEditForm')->name('tasks.edit');
Route::post('/folders/{folder}/tasks/{task}/edit', 'TaskController@edit');
