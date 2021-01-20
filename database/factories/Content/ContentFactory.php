<?php

namespace Database\Factories\Content;

use App\Models\Content\Content;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Content::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'author_id' => 8,
            'subcription_type_id' => rand(1, 3),
            'title' => $this->faker->city,
            'description' => $this->faker->paragraph(),
            'video_path' => 'V.mp4'
        ];
    }
}
