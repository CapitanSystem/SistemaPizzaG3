<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $table="categorias";
    protected $primaryKey = 'iCatID';

    protected $fillable = [
        'cCatNombre',
        'cCatTipo',
        'cCatDescripcion',
        'cCatEstado',
    ];
    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class, 'iProCategoriaID', 'iCatID');
    }

}
