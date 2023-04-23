<?php

namespace App\Http\Controllers;
use App\Http\Requests\StorePost;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;


// use Illuminate\Support\Facades\DB;

// [
//     'show' => 'view',
//     'create' => 'create',
//     'store' => 'create',
//     'edit' => 'update',
//     'update' => 'update',
//     'destroy' => 'delete',
// ]
class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // DB::connection()->enableQueryLog();
        // $posts = Post::all();
        // foreach($posts as $post) {
        //     foreach ($post->comments as $comment) {
        //         echo $comment->content;
        //     }
        // }
        // dd(DB::getQueryLog());
        return view('posts.index',
            [
                'posts' => Post::latest()->withCount('comments')->get(),
                'mostCommented' => Post::mostCommented()->take(5)->get(),
                'mostActive' => User::withMostPosts()->take(5)->get(),
            ]
        );
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
    public function store(StorePost $request)    // nhớ đổi Request -> StorePost để dùng validated()
    {   
        $validated = $request->validated();   /// rule trong app/Http/Requests/StorePost.php
        // $post = new Post();
        // $post -> title = $validated['title'];
        // $post -> content = $validated['content'];
        // $post -> save();

        $validated['user_id'] = $request->user()->id;
        $post = Post::create($validated);
        $request->session()->flash('status', 'The post created susscess!');
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

        return view('posts.show', ['post' => Post::with('comments')->findOrFail($id)]);
        // dùng local query để xếp comment trong post theo thứ tự mới nhất->xa nhất
        // return view('posts.show', ['post' => Post::with(['comments' => function($query) {
        //     return $query->latest();
        // }])->findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        // return view('posts.edit', ['post' => Post::findOrFail($id)]);
        $post = Post::findOrFail($id);

        // if (Gate::denies('update-post', $post)) {
        //     abort(403, 'You can not edit post');
        // }

        $this->authorize($post);    //       cụ thể có thể viết ntn:    $this->authorize('update', $post);


        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, $id)   // nhớ đổi Request -> StorePost để dùng validated()
    {
        $post = Post::findOrFail($id);

        // if (Gate::denies('update-post', $post)) {
        //     abort(403, 'You can not edit post');
        // }

        $this->authorize($post); //     cụ thể có thể viết ntn:   $this->authorize('update', $post);

        $validated = $request->validated();
        $post->fill($validated);
        $post->save();

        $request->session()->flash('status', 'Post was updated!');
        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // if (Gate::denies('delete-post', $post)) {
        //     abort(403, 'You can not delete post');
        // }
        $this->authorize($post); //     cụ thể có thể viết ntn:        $this->authorize('delete', $post);

        $post->delete();

        session()->flash('status', 'Post "' . $post->title . '" was deleted!');
        return redirect()->route('posts.index');
    }
}
