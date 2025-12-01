<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'slug' => Str::slug($this->faker->name()),
            'state' => true,
            'image' => '/storage/brands/default.jpg'
           // 'image' => '/storage/brands/' . $this->faker->image('public/storage/brands', 200, 150, null, false),
        ];
    }
}
