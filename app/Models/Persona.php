<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Persona extends Model
{
    use HasFactory;

    protected $table = 'personas';
    protected $primaryKey = 'iPerID';

    protected $fillable = [
        'cPerNombre',
        'cPerApellido',
        'cPerDNI',
        'cPerEmail',
        'cPerFNacimiento',
        'cPerTelefono',
        'cPerDireccion'
    ];

    protected $casts = [
        'cPerFNacimiento' => 'date'
    ];

    // Relaciones
    public function usuario(): HasOne
    {
        return $this->hasOne(Usuario::class, 'iUsuPersonaID', 'iPerID');
    }

    public function cliente(): HasOne
    {
        return $this->hasOne(Cliente::class, 'iCliPersonaID', 'iPerID');
    }

    public function empleado(): HasOne
    {
        return $this->hasOne(Empleado::class, 'iEmpPersonaID', 'iPerID');
    }
}
