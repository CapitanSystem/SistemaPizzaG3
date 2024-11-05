<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas';
    protected $primaryKey = 'iVentID';

    protected $fillable = [
        'iVenClienteID',
        'dVenFecha',
        'fVenTotal',
        'cVenEstado'
    ];

    protected $casts = [
        'dVenFecha' => 'date',
        'fVenTotal' => 'decimal:2'
    ];

    // Relaciones
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'iVenClienteID', 'iCliID');
    }

    public function detalles(): HasMany
    {
        return $this->hasMany(DetalleVenta::class, 'iDetVentaID', 'iVentID');
    }
}
