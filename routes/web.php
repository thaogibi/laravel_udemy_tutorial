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
  // ->middleware('auth');

Route::get('/contact', 'HomeController@contact')->name('home.contact');

Route::get('/secret', 'HomeController@secret')
  ->name('home.secret')
  ->middleware('can:home.secret');

Route::get('/', 'HomeController@index')->name('home.index');

Route::resource('posts', 'PostsController');

Auth::routes();