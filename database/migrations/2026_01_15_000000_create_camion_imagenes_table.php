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
        Schema::create('camion_imagenes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('camion_id');
            $table->string('url');
            $table->unsignedInteger('posicion')->default(1);
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('camion_id')
                ->references('id')
                ->on('camiones')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('camion_imagenes');
    }
};
