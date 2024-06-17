<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Carbon\Carbon;

use App\Observers\OrdenObserver;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use Illuminate\Database\Eloquent\Casts\Attribute;

use App\Enums\EstadosOrden;
use App\Enums\EstadosPago;
use App\Enums\EstadosEnvio;

#[ObservedBy(OrdenObserver::class)]
class Orden extends Model
{
    use CrudTrait;
    use HasFactory, SoftDeletes;

    protected $table = 'ordenes';

    protected $attributes = [
        'estado' => EstadosOrden::PENDIENTE->value,
    ];

    protected $appends = [
        'montoPago',
        'estadoPago',
        'fechaPago',
        'direccionEnvio',
        'nombreDivisa',
        'nombreMetodoPago',
        'fechaEnvio',
        'fechaRecepcion',
        'estadoEnvio',
        'precioEnvio',
    ];

    protected $fillable = [
        'estado',
        'user_id',
    ];

    public function pago(): BelongsTo
    {
        return $this->belongsTo(Pago::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function productos(): BelongsToMany
    {
        return $this->belongsToMany(Producto::class, 'detalles_de_orden')->withPivot('cantidad');
    }

    public function envio(): BelongsTo
    {
        return $this->belongsTo(Envio::class);
    }

    public function casts(): array
    {
        return [
            'created_at' => 'datetime:Y-m-d',
            'updated_at' => 'datetime:Y-m-d',
            'estadosEnvio' => EstadosEnvio::class,
            'estadoPago' => EstadosPago::class,
            'estado' => EstadosOrden::class,
        ];
    }

    // INFORMACION DEL PAGO
    public function montoPago(): Attribute
    {
        return new Attribute(
            get: fn () => $this->pago?->monto
        );
    }

    public function estadoPago(): Attribute
    {
        return new Attribute(
            get: fn () => $this->pago?->estado
        );
    }

    public function fechaPago(): Attribute
    {
        return new Attribute(
            get: fn () => $this->pago?->fechaPago
        );
    }


    // INFORMACION DEL ENVIO
    public function direccionEnvio(): Attribute
    {
        return new Attribute(
            get: fn () => $this->envio?->direccion
        );
    }

    public function fechaEnvio(): Attribute
    {
        return new Attribute(
            get: fn () => $this->envio?->fechaEnvio
        );
    }

    public function fechaRecepcion(): Attribute
    {
        return new Attribute(
            get: fn () => $this->envio?->fechaRecepcion
        );
    }

    public function estadoEnvio(): Attribute
    {
        return new Attribute(
            get: fn () => $this->envio?->estado
        );
    }

    public function precioEnvio(): Attribute
    {
        return new Attribute(
            get: fn () => $this->envio?->precio
        );
    }

    public function metodoPago(): Attribute
    {
        return new Attribute(
            get: fn () => $this->pago?->metodoPago
        );
    }

    public function nombreDivisa(): Attribute
    {
        return new Attribute(
            get: fn () => $this->pago?->nombreDivisa
        );
    }

    public function nombreMetodoPago(): Attribute
    {
        return new Attribute(
            get: fn () => $this->pago?->nombreMetodoPago
        );
    }
}
