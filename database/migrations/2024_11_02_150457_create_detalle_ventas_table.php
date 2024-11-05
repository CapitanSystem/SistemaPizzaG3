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
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->id('iDetID');
            $table->foreignId('iDetVentaID')->constrained('ventas', 'iVentID');
            $table->foreignId('iDetProductoID')->constrained('productos', 'iProID');
            $table->integer('iDetCantidad');
            $table->decimal('fDetSubTotal', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_ventas');
    }
};
