<?php

namespace App\Http\Controllers;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostTagController extends Controller
{
    public function index($tag) {
        $tag = Tag::findOrFail($tag);
        return view('posts.index', [
            'posts' => $tag->posts()
                ->latesWithRelations()   //scopeLatesWithRelations đã định nghĩa trong post.php
                ->get(),
            // // sau khi định nghĩa trong /Applications/XAMPP/xamppfiles/htdocs/laravel/app/Http/ViewComposers/ActivityComposer.php thì bỏ đi đc (v173)
            // 'mostCommented' => [],             
            // 'mostActive' => [],
            // 'mostActiveLastMonth' => [],
        ]);
    }
}
