<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class PostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tagCount = Tag::all()->count();
        if($tagCount == 0) {
            $this->command->info('No tag found');
            return;
        }

        $howManyMinTag = (int)$this->command->ask('Mininum tags on a post do you want to create?', 0);
        $howManyMaxTag = min((int)$this->command->ask('Maxinum tags on a post do you want to create?', $tagCount), $tagCount);

        Post::all()->each(function (Post $post) use ($howManyMinTag, $howManyMaxTag){
            $take = random_int($howManyMinTag, $howManyMaxTag);
            $tags = Tag::inRandomOrder()->take($take)->get()->pluck('id');
            $post->tags()->sync($tags);
        });
    }
}
