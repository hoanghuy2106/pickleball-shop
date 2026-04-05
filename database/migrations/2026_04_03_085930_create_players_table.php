<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up() {
    Schema::create('players', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('rank_title'); // Pro, Elite, Amateur
        $table->string('region');     // Miền Nam, Miền Bắc
        $table->integer('elo_points'); // Điểm Elo
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
