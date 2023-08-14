<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Image;
use App\Models\Post;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Image::class;
    public function definition(): array
    {
        return [
            'filename'=>fake()->name,
            'post_id'=>Post::factory()
        ];
    }
}
