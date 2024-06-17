<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

use App\Models\Pago;

use App\Enums\EstadosPago;

class PagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pago::create([
            'monto' => 100.0,
            'fechaPago' => Carbon::now(),
            'estado' => EstadosPago::ACEPTADO,
            'divisa_id' => 1,
            'metodo_de_pago_id' => 1,
        ]);
        Pago::create([
            'monto' => 80.0,
            'fechaPago' => Carbon::now(),
            'estado' => EstadosPago::ACEPTADO,
            'divisa_id' => 1,
            'metodo_de_pago_id' => 1,
        ]);
        Pago::create([
            'monto' => 60.0,
            'fechaPago' => Carbon::now(),
            'estado' => EstadosPago::PROCESANDO,
            'divisa_id' => 1,
            'metodo_de_pago_id' => 2,
        ]);
        Pago::create([
            'monto' => 50.0,
            'estado' => EstadosPago::PENDIENTE,
        ]);
        Pago::create([
            'monto' => 40.0,
            'estado' => EstadosPago::PENDIENTE,
        ]);
        Pago::create([
            'monto' => 80.0,
            'estado' => EstadosPago::PENDIENTE,
        ]);
    }
}
