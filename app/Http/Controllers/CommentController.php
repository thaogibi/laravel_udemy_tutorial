<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function __construct() {
        $this->middleware('auth')->only(['store']);
    }
    
    public function store(Post $post, StoreComment $request) {
        // Comment::create();
        $post->comments()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id
        ]);

        $request->session()->flash('status', 'Comment was created');

        return redirect()->back();
    }
}
