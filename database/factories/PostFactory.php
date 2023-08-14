<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'title'=>$this->fake()->sentence(),
            'content'=>$this->fake()->paragraph(),
            'author_id'=>User::factory(),
            'category_id'=>Category::factory(),
            
    ];
     
    }
}
