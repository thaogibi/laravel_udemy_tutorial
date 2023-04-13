<?php
use App\Http\Controllers\PostsController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
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

// Route::get('/laravel', function () {
//     return view('welcome');
// })->name('welcome.index');

// Route::view('/laravel', 'welcome')->name('welcome.index');

Route::get('/laravel', 'HomeController@welcome')->name('welcome.index');




// Route::get('/', function() {
//     return view('home.index');
// })->name('home.index');

// Route::view('/', ('home.index'))->name('home.index');

Route::get('/', 'HomeController@index')->name('home.index');








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

// Route::get('/posts', function(Request $request) use ($posts) {
//     request()->all();
//     return view('posts.index', ['posts' => $posts]); //compact($posts)
// });

// Route::get('posts/{id}', function($id) use ($posts){
//     abort_if(!isset($posts[$id]), 404);
//     return view('posts.show', ['post' => $posts[$id]]);
// })->name('posts.show');

// Route::get('recent-posts/{days_ago?}', function($days_ago) {
//     return 'Posts from ' . $days_ago; 
// })->where([
//     'days_ago' => '[0-9]+'
// ])->name('posts.recent.index')->middleware('auth');


Route::resource('posts', 'PostsController');











//grouping routes
Route::prefix('/fun')->name('fun.')->group(function() use($posts) {
    Route::get('responses', function() use($posts) {
        return response($posts, 201) 
            -> header('Content-Type', 'application/json') 
            -> cookie('MY_COOKIE', 'Th aoGiBi', 3600);
    })->name('responses');

    Route::get('redirect', function () {
        return redirect('/');
    })->name('redirect');

    Route::get('back', function () {
        return back();
    })->name('back');

    Route::get('named_route', function () {
        return redirect() ->route('posts.show', ['id' => 1]);
    })->name('named_route');

    Route::get('away', function () {
        return redirect()->away('https://google.com');
    })->name('away');

    //trả về json (có thể xem trên POSTMAN)
    Route::get('json', function () use($posts) {
        return response()->json($posts);
    })->name('json');

    //download file
    Route::get('download', function () use($posts) {
        return response()->download(public_path('/gd.jpg'), 'gdragon.jpg');
    })->name('download');
});