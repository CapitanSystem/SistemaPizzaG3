<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados';
    protected $primaryKey = 'iEmpID';

    protected $fillable = [
        'dEmpFechaInicio',
        'dEmpFechaFin',
        'fEmpSueldo',
        'iEmpPersonaID'
    ];

    protected $casts = [
        'dEmpFechaInicio' => 'date',
        'dEmpFechaFin' => 'date',
        'fEmpSueldo' => 'decimal:2'
    ];

    // Relaciones
    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class, 'iEmpPersonaID', 'iPerID');
    }
}
