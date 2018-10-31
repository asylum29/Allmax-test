<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

\Illuminate\Support\Facades\Auth::routes();
\Illuminate\Support\Facades\Route::get('/', 'TaskController@index');
\Illuminate\Support\Facades\Route::get('/tasks', 'TaskController@index')
    ->name('task.tasks');
\Illuminate\Support\Facades\Route::any('/task/create', 'TaskController@create')
    ->name('task.create');
\Illuminate\Support\Facades\Route::any('/task/update/{task}', 'TaskController@update')
    ->name('task.update');
\Illuminate\Support\Facades\Route::post('/task/delete/{task}', 'TaskController@delete')
    ->name('task.delete');
