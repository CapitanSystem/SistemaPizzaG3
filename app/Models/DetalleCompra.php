<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    use HasFactory;

    protected $table = 'detalle_compras';
    protected $primaryKey = 'iDetComID';

    protected $fillable = [
        'iDetComCompraID',
        'iDetComProductoID',
        'iDetComCantidad',
        'fDetComSubTotal'
    ];

    protected $casts = [
        'iDetComCantidad' => 'integer',
        'fDetComSubTotal' => 'decimal:2'
    ];

    // Relaciones
    public function compra(): BelongsTo
    {
        return $this->belongsTo(Compra::class, 'iDetComCompraID', 'iComID');
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'iDetComProductoID', 'iProID');
    }
}
