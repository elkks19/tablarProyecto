<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

use App\Models\Envio;
use App\Enums\EstadosEnvio;

class EnvioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Envio::create([
            'direccion' => 'Calle 123',
            'fechaEnvio' => Carbon::now(),
            'fechaRecepcion' => Carbon::now(),
            'estado' => EstadosEnvio::RECIBIDO,
            'precio' => 100.00
        ]);
        Envio::create([
            'direccion' => 'Calle 234',
            'fechaEnvio' => Carbon::now(),
            'estado' => EstadosEnvio::ENVIADO,
            'precio' => 50.00
        ]);
        Envio::create([
            'direccion' => 'Calle 914',
            'fechaEnvio' => Carbon::now(),
            'fechaRecepcion' => Carbon::now(),
            'estado' => EstadosEnvio::RECIBIDO,
            'precio' => 100.00
        ]);
        Envio::create([
            'direccion' => 'Calle 123',
            'fechaEnvio' => Carbon::now(),
            'fechaRecepcion' => Carbon::now(),
            'estado' => EstadosEnvio::RECIBIDO,
            'precio' => 80.00
        ]);
        Envio::create([
            'direccion' => 'Calle 929',
            'fechaEnvio' => Carbon::now(),
            'fechaRecepcion' => Carbon::now(),
            'estado' => EstadosEnvio::RECIBIDO,
            'precio' => 10.00
        ]);
        Envio::create([
            'direccion' => 'Calle 154',
            'fechaEnvio' => Carbon::now(),
            'estado' => EstadosEnvio::ENVIADO,
            'precio' => 15.00
        ]);
    }
}
