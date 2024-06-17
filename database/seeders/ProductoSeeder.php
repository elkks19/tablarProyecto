<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Producto::create([
            'nombre' => 'Producto 1',
            'descripcion' => 'Producto 1',
            'precio' => 80,
        ])->categorias()->attach([1, 3]);
        Producto::create([
            'nombre' => 'Producto 2',
            'descripcion' => 'Producto 2',
            'precio' => 60,
        ])->categorias()->attach([1, 2]);
        Producto::create([
            'nombre' => 'Producto 3',
            'descripcion' => 'Producto 3',
            'precio' => 20,
        ])->categorias()->attach([4, 5]);
        Producto::create([
            'nombre' => 'Producto 4',
            'descripcion' => 'Producto 4',
            'precio' => 80,
        ])->categorias()->attach([1, 4]);
        Producto::create([
            'nombre' => 'Producto 5',
            'descripcion' => 'Producto 5',
            'precio' => 10,
        ])->categorias()->attach([1, 3]);
        Producto::create([
            'nombre' => 'Producto 6',
            'descripcion' => 'Producto 6',
            'precio' => 100,
        ])->categorias()->attach([1, 2]);
    }
}
