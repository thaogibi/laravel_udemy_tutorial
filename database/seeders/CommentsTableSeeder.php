<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::all();
        // kiểm tra xem nếu ko có post nào thì ko tạo comment đc => thông báo
        if($posts->count() <= 0) {
            $this->command->info('Opps! No posts found, so can not create any comments!');
            return;
        }
        
        //tạo 50 bản
            // Comment::factory(50)->make()->each(function($comment) use ($posts){
            //     $comment->post_id = $posts->random()->id;
            //     $comment->save();
            // });

        //hoặc hỏi số lượng trước khi tạo
            $commentsCount = (int) $this->command->ask('How many comments do you want to create?', 10);  //set default = 10
            Comment::factory($commentsCount)->make()->each(function($comment) use ($posts){
                $comment->post_id = $posts->random()->id;
                $comment->save();
            });
    }
}
