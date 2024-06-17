<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Divisa;

class DivisaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Divisa::create(['nombre' => 'Dólar', 'simbolo' => 'USD', 'tasa' => 1]);
        Divisa::create(['nombre' => 'Dólar Canadiense', 'simbolo' => 'CAD', 'tasa' => 1.25]);
        Divisa::create(['nombre' => 'Euro', 'simbolo' => 'EUR', 'tasa' => 0.85]);
        Divisa::create(['nombre' => 'Libra Esterlina', 'simbolo' => 'GBP', 'tasa' => 0.72]);
        Divisa::create(['nombre' => 'Peso Mexicano', 'simbolo' => 'MXN', 'tasa' => 20.5]);
    }
}
