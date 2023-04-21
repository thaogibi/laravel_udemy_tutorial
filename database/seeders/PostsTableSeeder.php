<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        //tạo 20 bản
            // Post::factory()->count(20)->make()->each(function($post) use ($users) {
            //     $post->user_id = $users->random()->id;
            //     $post->save();
            // });


        //hoặc hỏi số lượng trước khi tạo
            $postsCount = max((int) $this->command->ask('How many posts do you want to create?', 10), 1 );  //set default = 10
            Post::factory()->count($postsCount)->make()->each(function($post) use ($users) {
                $post->user_id = $users->random()->id;
                $post->save();
            });
    }
}
