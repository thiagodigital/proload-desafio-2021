<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Feed;

class FeedFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Feed::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->text,
            'pubDate' => $this->faker->dateTime(),
            'image' => $this->faker->text,
            'guid' => $this->faker->uuid,
            'link' => $this->faker->word,
            'status' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
