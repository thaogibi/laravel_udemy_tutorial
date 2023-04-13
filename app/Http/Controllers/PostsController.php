<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    // private $posts = [
    //     1 => [
    //         'title' => 'title1',
    //         'content' => 'content1'
    //     ],
    //     2 => [
    //         'title' => 'title2',
    //         'content' => 'content2'
    //     ],
    //     3 => [
    //         'title' => 'title3',
    //         'content' => 'content3'
    //     ],
    //     4 => [
    //         'title' => 'title4',
    //         'content' => 'content4'
    //     ],
    //     5 => [
    //         'title' => 'title5',
    //         'content' => 'content5'
    //     ]
    // ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index', ['posts' => Post::all()]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate([
            'title' => 'bail|required|min:5|max:50',
            'content' => 'min:10'
        ]);
        $post = new Post();
        $post -> title = $request->input('title');
        $post -> content = $request->input('content');
        $post -> save();

        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response 
     */
    public function show($id)
    {
        // abort_if(!isset($this -> posts[$id]), 404);
        // return view('posts.show', ['post' => $this -> posts[$id]]);
        return view('posts.show', ['post' => Post::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
