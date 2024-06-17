<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\MetodoPago;

class MetodoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MetodoPago::create(['nombre' => 'Efectivo']);
        MetodoPago::create(['nombre' => 'Tarjeta de débito']);
        MetodoPago::create(['nombre' => 'Tarjeta de crédito']);
        MetodoPago::create(['nombre' => 'Transferencia bancaria']);
        MetodoPago::create(['nombre' => 'QR']);
        MetodoPago::create(['nombre' => 'Cheque']);
    }
}
