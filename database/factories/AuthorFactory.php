<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AuthorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Author::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Author $author) {
            $author->profile()->save(Profile::factory()->make());
        });
    }
}
