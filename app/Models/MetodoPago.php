<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\HasMany;

class MetodoPago extends Model
{
    use CrudTrait;
    use HasFactory, SoftDeletes;

    public $timestamps = false;

    protected $table = 'metodos_de_pago';

    protected $fillable = [
        'nombre',
    ];

    public function pagos(): HasMany
    {
        return $this->hasMany(Pago::class);
    }
}
