<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;   //them vao

class HomeController extends Controller
{
    public function index() {
        return view('home.index');
    }

    public function welcome() {
        return view('home.welcome');
    }
    public function contact() {
        return view('home.contact');
    }

    public function secret() {
        return view('home.secret');
    }
    
}

