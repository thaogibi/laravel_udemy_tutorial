<?php
use App\Http\Controllers\PostsController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::get('/laravel', 'HomeController@welcome')->name('laravel');
Route::get('/', 'HomeController@index')->name('home.index');


Route::resource('posts', 'PostsController');
    // ->only(['index', 'show', 'create', 'store', 'edit', 'update']);
Auth::routes();

