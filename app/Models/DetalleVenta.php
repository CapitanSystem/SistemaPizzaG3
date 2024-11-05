<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalleVenta extends Model
{
    use HasFactory;

    protected $table = 'detalle_ventas';
    protected $primaryKey = 'iDetID';

    protected $fillable = [
        'iDetVentaID',
        'iDetProductoID',
        'iDetCantidad',
        'fDetSubTotal'
    ];

    protected $casts = [
        'iDetCantidad' => 'integer',
        'fDetSubTotal' => 'decimal:2'
    ];

    // Relaciones
    public function venta(): BelongsTo
    {
        return $this->belongsTo(Venta::class, 'iDetVentaID', 'iVentID');
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'iDetProductoID', 'iProID');
    }
}
