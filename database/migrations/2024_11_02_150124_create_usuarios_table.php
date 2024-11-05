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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('iUsuID');
            $table->string('cUsuUsuario', 50)->unique();
            $table->string('cUsuPassword', 255);
            $table->foreignId('iUsuPersonaID')->constrained('personas', 'iPerID');
            $table->char('cUsuEstado', 1)->default('A');
            $table->char('cUsuRol', 1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
