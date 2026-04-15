<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('referencias', function (Blueprint $table) {
            $table->id();
            $table->string('publicacion', 255);
            $table->text('descripcion')->nullable();
            $table->string('imagen1', 255)->nullable();
            $table->string('imagen2', 255)->nullable();
            $table->string('imagen3', 255)->nullable();
            $table->string('imagen4', 255)->nullable();
            $table->string('imagen5', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('referencias');
    }
};
