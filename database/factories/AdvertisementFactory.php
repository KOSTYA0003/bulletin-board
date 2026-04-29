<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdvertisementFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $items = [
            'iPhone 15 Pro',
            'Кроссовки Nike',
            'Игровой ноутбук',
            'Велосипед горный',
            'Кофемашина',
            'Монитор 27 дюймов',
            'Кожаный диван',
            'Набор инструментов',
            'Электросамокат',
            'Умные часы',
            'Гитара акустическая',
            'Фотоаппарат Canon',
        ];

        $prefixes = ['Продам', 'Срочно продам', 'В отличном состоянии', 'Почти новый', 'Оригинальный'];

        return [
            'title' => fake()->randomElement($prefixes).' '.fake()->randomElement($items),
            'description' => fake()->paragraph(3),
            'price' => fake()->numberBetween(1500, 95000),
            'images' => [],
            'status' => 'approved',
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
        ];
    }
}
