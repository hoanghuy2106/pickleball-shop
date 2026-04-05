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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brand')->nullable();
            $table->bigInteger('price');
            $table->string('color')->nullable();
            $table->text('description')->nullable(); 
            $table->string('image')->nullable(); // Ảnh chính (đại diện)
            
            // --- THÊM DÒNG NÀY ĐỂ CHẠY ĐƯỢC SLIDER ---
            $table->json('gallery')->nullable(); // Lưu mảng nhiều ảnh phụ
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};