<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CategoriesTableSeeder::class);

        User::factory()->admin()->create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => \Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@test.com',
            'password' => \Hash::make('password'),
        ]);

        $users = User::factory(10)->create();

        $leafCategories = Category::doesntHave('children')->get();

        foreach ($leafCategories as $category) {
            Advertisement::factory(rand(2, 3))->create([
                'category_id' => $category->id,
                'user_id' => $users->random()->id,
            ]);
        }
    }
}
