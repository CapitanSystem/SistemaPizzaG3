<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $primaryKey = 'iCliID';

    protected $fillable = [
        'iCliPersonaID'
    ];

    // Relaciones
    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class, 'iCliPersonaID', 'iPerID');
    }

    public function ventas(): HasMany
    {
        return $this->hasMany(Venta::class, 'iVenClienteID', 'iCliID');
    }
}
