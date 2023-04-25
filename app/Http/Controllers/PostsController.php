<?php

namespace App\Http\Controllers;
use App\Http\Requests\StorePost;
use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;


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

        //đã chuyển sang /Applications/XAMPP/xamppfiles/htdocs/laravel/app/Http/ViewComposers/ActivityComposer.php
                // // $mostCommented = Cache::remember('mostCommented', 60, function() {
                // $mostCommented = Cache::remember('post-commented', 60, function() {
                //     return Post::mostCommented()->take(5)->get();
                // });

                // // $mostActive = Cache::remember('mostActive', 60, function() {
                // $mostActive = Cache::remember('users-most-active', 60, function() {
                //     return User::withMostPosts()->take(5)->get();
                // });

                // // $mostActiveLastMonth = Cache::remember('mostActiveLastMonth', 60, function() {
                // $mostActiveLastMonth = Cache::remember('users-most-active-last-month', 60, function() {
                //     return User::withMostPostsLastMonth()->take(5)->get();
                // });


        return view('posts.index',
            [
                'posts' => Post::latesWithRelations()->get(),  // //scopeLatesWithRelations đã định nghĩa trong post.php
                // 'mostCommented' => $mostCommented,
                // 'mostActive' => $mostActive,
                // 'mostActiveLastMonth' => $mostActiveLastMonth,
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



        //file/ thumbnail
        // $hasFile = $request->hasFile('thumbnail');
        // // dump($hasFile);

        // if ($hasFile) {
        //     $file = $request->file('thumbnail');

            //lấy thông tin file
                //dùng dump để xem cũng đc
                    // dump($file);
                    // dump($file->getClientMimeType());
                    // dump($file->getClientOriginalExtension());
                    // dump($file->getClientOriginalName());
            // $fileName = $file->getClientOriginalName();
            // echo 'Tên file: ' . $fileName . '<br>';
            // echo 'Kích thước: ' . $file->getSize() . '<br>';
            // echo 'Đường dẫn thư mục: ' . $file->getRealPath() . '<br>';
            // echo 'Kiểu file: ' . $file->getMimeType() . '<br>';
            // echo 'Đuôi mở rộng - ClientOriginalExtension: ' . $file->getClientOriginalExtension() . '<br>';
            // echo 'Đuôi mở rộng - Extension: ' . $file->guessExtension() . '<br>';




            // //lưu trữ và đặt tên file
            //     // lưu trữ ở public ('root' => storage_path('app/public') do .env đã set 'FILESYSTEM_DRIVER=public'; và filesystems 
            //         // đơn thuần: đặt ko đổi tên (2 dòng dưới đây tương đương nhau)
            //             // echo ($file->store('thumbnails'));   /
            //             // dump(Storage::disk('public')->putFile('thumbnails', $file));

            //     // lưu trữ ở local  ('root' => storage_path('app') do .env đã set 'FILESYSTEM_DRIVER=public'; và filesystems 
            //         // có đổi tên (2 dòng dưới đây tương đương nhau)
            //             $l1 = $file->storeAs('thumbnails', $post->id . '.'. $file->getClientOriginalExtension());                     
            //             // $l2 = Storage::disk('local')->putFileAs('thumbnails', $file, $post->id . '.' . $file->getClientOriginalExtension());  
            //             echo $l1.'<br>';
            //             dump(Storage::url($l1));                    //-> "http://localhost/storage/thumbnails/76.png"   ; sau khi đổi trong .env là APP_URL=http://laravel.test thì gt mới là "http://laravel.test/storage/thumbnails/81.png"
            //             dump(Storage::disk('local')->url($l1));     //-> "/storage/thumbnails/80.png"


        if($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $path = $file->store('thumbnails'); 
            $post->image()->save(
                Image::make(['path' => $path])
            );
        }
        


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





        // return view('posts.show', ['post' => Post::with('comments')->findOrFail($id)]);
        // $post = Cache::remember("post-{$id}", 60, function() use ($id) {
        //     return Post::with('comments')->findOrFail($id);
        // });

        $post = Cache::tags(['post'])->remember("post-{$id}", 60, function() use($id) {
            return Post::with('comments', 'tags', 'user', 'comments.user')
                ->with('tags')
                ->with('user')
                ->with('comments.user')
                ->findOrFail($id);
        });


        $sessionId = session()->getId();
        $counterKey = "post-{$id}-counter";
        $usersKey = "post-{$id}-users";

        // $users = Cache::get($usersKey, []);
        $users = Cache::tags(['post'])->get($usersKey, []);
        $usersUpdate = [];
        $diffrence = 0;
        $now = now();

        foreach ($users as $session => $lastVisit) {
            if ($now->diffInMinutes($lastVisit) >= 1) {
                $diffrence--;
            } else {
                $usersUpdate[$session] = $lastVisit;
            }
        }

        if(!array_key_exists($sessionId, $users) || $now->diffInMinutes($users[$sessionId]) >= 1) {
            $diffrence++;
        }

        $usersUpdate[$sessionId] = $now;


        
        // Cache::forever($usersKey, $usersUpdate);

        // if (!Cache::has($counterKey)) {
        //     Cache::forever($counterKey, 1);
        // } else {
        //     Cache::increment($counterKey, $diffrence);
        // }
        
        // $counter = Cache::get($counterKey);


        Cache::tags(['post'])->forever($usersKey, $usersUpdate);

        if (!Cache::tags(['post'])->has($counterKey)) {
            Cache::tags(['post'])->forever($counterKey, 1);
        } else {
            Cache::tags(['post'])->increment($counterKey, $diffrence);
        }
        
        $counter = Cache::tags(['post'])->get($counterKey);


        return view('posts.show', [
            'post' => $post,
            'counter' => $counter,
        ]);


        
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

        if($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $path = $file->store('thumbnails'); 
            if($post->image) {  //check nếu có ảnh cũ thì xoá
                Storage::delete($post->image->path);
                $post->image->path = $path;
                $post->image->save();
            }else {
                $post->image()->save(
                    Image::make(['path' => $path])
                );
            }

        $request->session()->flash('status', 'Post was updated!');
        return redirect()->route('posts.show', ['post' => $post->id]);
        }
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
