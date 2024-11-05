<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Producto extends Model
{
    use HasFactory;
    protected $table="productos";
    protected $primaryKey = 'iProID';

    protected $fillable = [
        'cProNombre',
        'cProDescripcion',
        'cProTamanio',
        'fProPrecioCompra',
        'fProPrecioVenta',
        'iProStock',
        'iProCategoriaID',
        'cProImagen',
        'cProEstado',
    ];

    protected $casts = [
        'fProPrecioCompra' => 'decimal:2',
        'fProPrecioVenta' => 'decimal:2',
        'iProStock' => 'integer'
    ];

    // Relaciones
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'iProCategoriaID', 'iCatID');
    }

    public function detalleVentas(): HasMany
    {
        return $this->hasMany(DetalleVenta::class, 'iDetProductoID', 'iProID');
    }

    public function detalleCompras(): HasMany
    {
        return $this->hasMany(DetalleCompra::class, 'iDetComProductoID', 'iProID');
    }

}
