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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id('iEmpID');
            $table->date('dEmpFechaInicio');
            $table->date('dEmpFechaFin');
            $table->decimal('fEmpSueldo', 10, 2);
            $table->foreignId('iEmpPersonaID')->constrained('personas', 'iPerID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
