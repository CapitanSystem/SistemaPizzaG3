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
        Schema::create('detalle_compras', function (Blueprint $table) {
            $table->id('iDetComID');
            $table->foreignId('iDetComCompraID')->constrained('compras', 'iComID');
            $table->foreignId('iDetComProductoID')->constrained('productos', 'iProID');
            $table->integer('iDetComCantidad');
            $table->decimal('fDetComSubTotal', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_compras');
    }
};
