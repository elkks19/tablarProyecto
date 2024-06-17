<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Enums\EstadosEnvio;

class Envio extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'envios';

    protected $attributes = [
        'estado' => EstadosEnvio::PENDIENTE->value,
    ];

    protected $fillable = [
        'direccion',
        'fechaEnvio',
        'fechaRecepcion',
        'estado',
        'precio',
    ];

    public function casts(): array
    {
        return [
            'fechaEnvio' => 'datetime',
            'fechaRecepcion' => 'datetime',
        ];
    }

    public function orden(): HasOne
    {
        return $this->hasOne(Orden::class);
    }
}
