<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->integer('popularity')->default(0);
            $table->enum('status', ['active', 'expired'])->default('active');
            $table->date('valid_from');
            $table->date('valid_until');
            $table->timestamps();

            $table->foreignId('restaurant_id')
                ->constrained('restaurants')
                ->onDelete('cascade');

            //$table->foreignId('user_id')
            //    ->constrained('users')
            //    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
