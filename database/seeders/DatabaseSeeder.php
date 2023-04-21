<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //them vao 
use Illuminate\Support\Str;//them vao

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // thêm user
            // User::factory(10)->create();

            // DB::table('users')->insert([
            //     'name' => 'meomeo',
            //     'email' => 'meomeo@gmail.com',
            //     'email_verified_at' => now(),
            //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            //     'remember_token' => Str::random(10),
            // ]);

            // User::factory()->create([
            //     'name' => 'meomeo2',
            //     'email' => 'meomeo2@gmail.com',
            //     'email_verified_at' => now(),
            //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            //     'remember_token' => Str::random(10),
            // ]);

            // User::factory()->suspended()->create();



        //thêm post
            // $users = User::all();

            // Post::factory()->count(20)->make()->each(function($post) use ($users) {
            //     $post->user_id = $users->random()->id;
            //     $post->save();
            // });


        //thêm comment
            // $posts = Post::all();
            
            // Comment::factory(50)->make()->each(function($comment) use ($posts){
            //     $comment->post_id = $posts->random()->id;
            //     $comment->save();
            // });
    }
}
