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

// Route::get('/welcome', function () {
//     return view('welcome');
// })->name('welcome.index');

Route::view('/welcome', 'welcome')->name('welcome.index');

// Route::get('/', function() {
//     return view('home.index');
// })->name('home.index');

Route::view('/', ('home.index'))->name('home.index');

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

Route::get('/posts', function() use ($posts) {
    return view('posts.index', ['posts' => $posts]); //compact($posts)
});

Route::get('posts/{id}', function($id) use ($posts){
    abort_if(!isset($posts[$id]), 404);
    return view('posts.show', ['post' => $posts[$id]]);
})->name('posts.show');

Route::get('recent-posts/{days_ago?}', function($days_ago) {
    return 'Posts from ' . $days_ago; 
})->where([
    'days_ago' => '[0-9]+'
])->name('posts.recent.index');


Route::get('/fun/responses', function() use($posts) {
    return response($posts, 201) 
        -> header('Content-Type', 'application/json') 
        -> cookie('MY_COOKIE', 'Th aoGiBi', 3600);
});

Route::get('/fun/redirect', function () {
    return redirect('/');
});

Route::get('/fun/back', function () {
    return back();
});

Route::get('/fun/named_route', function () {
    return redirect() ->route('posts.show', ['id' => 1]);
});

Route::get('/fun/away', function () {
    return redirect()->away('https://google.com');
});

//trả về json (có thể xem trên POSTMAN)
Route::get('/fun/json', function () use($posts) {
    return response()->json($posts);
});

//download file
Route::get('/fun/download', function () use($posts) {
    return response()->download(public_path('/gd.jpg'), 'gdragon.jpg');
});
