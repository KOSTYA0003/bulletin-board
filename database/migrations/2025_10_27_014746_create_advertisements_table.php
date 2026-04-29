<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 10, 2)->nullable();
            $table->json('images')->nullable();

            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('category_id')
                ->constrained()
                ->onDelete('cascade');

            $table->timestamps();

            $table->index('status');
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('advertisements');
    }
};
