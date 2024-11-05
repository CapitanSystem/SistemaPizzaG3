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
        Schema::create('productos', function (Blueprint $table) {
            $table->id('iProID');
            $table->string('cProNombre', 60);
            $table->string('cProTamanio', 20);
            $table->decimal('fProPrecioCompra', 10, 2)->nullable();
            $table->decimal('fProPrecioVenta', 10, 2);
            $table->integer('iProStock');
            $table->foreignId('iProCategoriaID')->constrained('categorias', 'iCatID');
            $table->string('cProImagen', 255)->nullable();
            $table->char('cProEstado', 1)->default('A');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
