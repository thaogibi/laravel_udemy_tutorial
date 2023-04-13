<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome.index');

Route::get('posts/{id}', function($id) {
    return 'Post ' . $id; 
})->name('posts.show');

Route::get('recent-posts/{days_ago?}', function($days_ago) {
    return 'Posts from ' . $days_ago; 
})->where([
    'days_ago' => '[0-9]+'
])->name('posts.recent.index');
