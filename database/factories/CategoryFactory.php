<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->word();

        return [
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'description' => $this->faker->sentence(),
            'parent_id' => null,
            'level' => 1,
        ];
    }
}
