<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Empleado;
use App\Models\Persona;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $persona1 = Persona::create([
            'cPerNombre' => 'Juan',
            'cPerApellido' => 'Pérez',
            'cPerDNI' => '12345678',
            'cPerEmail' => 'juan.perez@example.com',
            'cPerFNacimiento' => '1990-01-01',
            'cPerTelefono' => '987654321',
            'cPerDireccion' => 'Calle Falsa 123',
        ]);

        Empleado::create([
            'iEmpPersonaID' => $persona1->iPerID,
            'dEmpFechaInicio' => '2024-01-01',
            'dEmpFechaFin' => '2024-12-31',
            'fEmpSueldo' => 1500.00,
        ]);

        $persona2 = Persona::create([
            'cPerNombre' => 'María',
            'cPerApellido' => 'Gómez',
            'cPerDNI' => '23456789',
            'cPerEmail' => 'maria.gomez@example.com',
            'cPerFNacimiento' => '1985-02-02',
            'cPerTelefono' => '987654320',
            'cPerDireccion' => 'Avenida Siempre Viva 742',
        ]);

        Empleado::create([
            'iEmpPersonaID' => $persona2->iPerID,
            'dEmpFechaInicio' => '2024-02-01',
            'dEmpFechaFin' => '2024-12-31',
            'fEmpSueldo' => 1600.00,
        ]);
    }
}
