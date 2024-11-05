<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;


class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'iUsuID';

    protected $fillable = [
        'cUsuUsuario',
        'cUsuPassword',
        'iUsuPersonaID',
        'cUsuEstado',
        'cUsuRol'
    ];

    protected $hidden = [
        'cUsuPassword',
    ];
    public function getAuthPassword()
    {
        return $this->cUsuPassword;
    }

    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class, 'iUsuPersonaID', 'iPerID');
    }
}
