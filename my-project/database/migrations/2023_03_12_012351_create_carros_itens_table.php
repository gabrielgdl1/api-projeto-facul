<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carros_itens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_carro');
            $table->foreign('id_carro')->references('id')->on('carros');
            $table->unsignedBigInteger('id_item');
            $table->foreign('id_item')->references('id')->on('itens');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carros_itens');
    }
};
