<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $table = 'compras';
    protected $primaryKey = 'iComID';

    protected $fillable = [
        'iComProveedorID',
        'dComFecha',
        'fComTotal'
    ];

    protected $casts = [
        'dComFecha' => 'date',
        'fComTotal' => 'decimal:2'
    ];

    // Relaciones
    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class, 'iComProveedorID', 'iProID');
    }

    public function detalles(): HasMany
    {
        return $this->hasMany(DetalleCompra::class, 'iDetComCompraID', 'iComID');
    }
}
