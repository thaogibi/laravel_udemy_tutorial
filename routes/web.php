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

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome.index');

Route::get('/', function() {
    return view('home.index');
});

Route::get('posts/{id}', function($id) {
    $posts = [
        1 => [
            'title' => 'title1',
            'content' => 'content1'
        ],
        2 => [
            'title' => 'title2',
            'content' => 'content2'
        ],
        3 => [
            'title' => 'title3',
            'content' => 'content3'
        ],
        4 => [
            'title' => 'title4',
            'content' => 'content4'
        ],
        5 => [
            'title' => 'title5',
            'content' => 'content5'
        ]
    ];
    abort_if(!isset($posts[$id]), 404);
    return view('posts.show', ['post' => $posts[$id]]);
})->name('posts.show');

Route::get('recent-posts/{days_ago?}', function($days_ago) {
    return 'Posts from ' . $days_ago; 
})->where([
    'days_ago' => '[0-9]+'
])->name('posts.recent.index');
