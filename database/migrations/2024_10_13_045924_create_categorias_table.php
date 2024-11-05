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
        Schema::create('categorias', function (Blueprint $table) {
            $table->id('iCatID');
            $table->string('cCatNombre', 70);
            $table->char('cCatTipo', 1)->check('cCatTipo IN ("C", "V", "A")');
            $table->string('cCatDescripcion', 120);
            $table->char('cCatEstado', 1)->default('A')->check('cCatEstado IN ("A", "I")');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
