<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orderlogs', function (Blueprint $table) {
            $table->id();
            
            $table->string('order_id');             
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('material_id')->nullable();
            $table->json('productname'); 
            $table->text('dimensions')->nullable();
            $table->integer('quantity');
            $table->string('provincie')->nullable();
            $table->string('status')->default('pending'); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderlogs');
    }
};