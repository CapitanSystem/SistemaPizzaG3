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
        Schema::create('personas', function (Blueprint $table) {
            $table->id('iPerID');
            $table->string('cPerNombre', 50);
            $table->string('cPerApellido', 50);
            $table->char('cPerDNI', 8)->unique();
            $table->string('cPerEmail', 60)->unique()->nullable();
            $table->date('cPerFNacimiento');
            $table->char('cPerTelefono', 9);
            $table->string('cPerDireccion', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
