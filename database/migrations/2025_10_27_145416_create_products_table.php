<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->integer('quantity');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        DB::table('products')->insert([
            [
                'name' => 'Ноутбук Dell XPS',
                'description' => 'Мощный ноутбук для работы и игр',
                'price' => 999.99,
                'quantity' => 10,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'iPhone 15 Pro',
                'description' => 'Флагманский смартфон Apple',
                'price' => 1199.99,
                'quantity' => 5,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Samsung Galaxy S24',
                'description' => 'Android смартфон с лучшей камерой',
                'price' => 899.99,
                'quantity' => 8,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'MacBook Air M2',
                'description' => 'Легкий и мощный ноутбук от Apple',
                'price' => 1299.99,
                'quantity' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Наушники Sony WH-1000XM4',
                'description' => 'Беспроводные наушники с шумоподавлением',
                'price' => 349.99,
                'quantity' => 15,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
