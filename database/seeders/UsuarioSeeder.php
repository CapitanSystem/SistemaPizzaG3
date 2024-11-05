<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crea un usuario administrador
        Usuario::create([
            'cUsuUsuario' => 'admin',
            'cUsuPassword' => bcrypt('admin123'),
            'iUsuPersonaID' => 1,
            'cUsuEstado' => 'A',
            'cUsuRol' => 'A'
        ]);

        // Crea un usuario empleado
        Usuario::create([
            'cUsuUsuario' => 'empleado',
            'cUsuPassword' => bcrypt('empleado123'),
            'iUsuPersonaID' => 2,
            'cUsuEstado' => 'A',
            'cUsuRol' => 'E'
        ]);
    }
}
