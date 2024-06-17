<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

use Illuminate\Database\Eloquent\Casts\Attribute;

use App\Enums\EstadosPago;

class Pago extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pagos';

    protected $attributes = [
        'estado' => EstadosPago::PENDIENTE->value,
    ];

    protected $fillable = [
        'monto',
        'fechaPago',
        'estado',
        'metodo_de_pago_id',
        'divisa_id',
    ];

    protected $appends = [
        'nombreDivisa',
        'nombreMetodoPago'
    ];

    public function casts(): array
    {
        return [
            'fechaPago' => 'datetime',
        ];
    }

    public function orden(): HasOne
    {
        return $this->hasOne(Orden::class);
    }

    public function metodo_de_pago(): BelongsTo
    {
        return $this->belongsTo(MetodoPago::class);
    }

    public function divisa(): BelongsTo
    {
        return $this->belongsTo(Divisa::class);
    }

    public function nombreDivisa(): Attribute
    {
        return new Attribute(
            get: fn () => $this->divisa?->nombre
        );
    }

    public function nombreMetodoPago(): Attribute
    {
        return new Attribute(
            get: fn () => $this->metodo_de_pago?->nombre
        );
    }

}
