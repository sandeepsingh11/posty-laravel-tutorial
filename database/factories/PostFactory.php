<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // create fake entries for testing.
            // in Tinker, exe: App\Models\Post::factory->times(200)->create(['user_id' => 2]);
            // * creates 200 fake entries with the specified data
            'body' => $this->faker->sentence(20)
        ];
    }
}
