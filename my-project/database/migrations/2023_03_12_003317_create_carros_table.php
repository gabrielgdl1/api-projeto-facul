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
        Schema::create('carros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_marca');
            $table->foreign('id_marca')->references('id')->on('marcas');
            $table->string('modelo');
            $table->string('cor');
            $table->string('ano');
            $table->integer('tipo_cambio');
            $table->integer('tipo_combustivel');
            $table->integer('tipo_carroceria');
            $table->integer('quilometragem');
            $table->tinyInteger('usado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carros');
    }
};
