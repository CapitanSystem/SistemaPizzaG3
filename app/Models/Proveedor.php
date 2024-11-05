<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    protected $table="proveedores";
    protected $primaryKey = 'iProID';

    protected $fillable = [
        'cProEmpresa',
        'cProRucEmpresa',
        'cProRazonSocial',
    ];

    public function compras(): HasMany
    {
        return $this->hasMany(Compra::class, 'iComProveedorID', 'iProID');
    }
}
