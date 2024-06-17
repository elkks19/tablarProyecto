<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Review::create([
            'contenido' => 'Muy buen producto',
            'calificacion' => 4,
            'producto_id' => 1,
            'user_id' => 1,
        ]);
        Review::create([
            'contenido' => 'Mal producto',
            'calificacion' => 1,
            'producto_id' => 2,
            'user_id' => 2,
        ]);
        Review::create([
            'contenido' => 'Producto regular',
            'calificacion' => 3,
            'producto_id' => 3,
            'user_id' => 1,
        ]);
        Review::create([
            'contenido' => 'El mejor producto',
            'calificacion' => 5,
            'producto_id' => 1,
            'user_id' => 1,
        ]);
        Review::create([
            'contenido' => 'meh',
            'calificacion' => 3,
            'producto_id' => 5,
            'user_id' => 2,
        ]);
        Review::create([
            'contenido' => 'regular',
            'calificacion' => 2,
            'producto_id' => 6,
            'user_id' => 3,
        ]);
        Review::create([
            'calificacion' => 5,
            'producto_id' => 3,
            'user_id' => 4,
        ]);
        Review::create([
            'calificacion' => 5,
            'producto_id' => 1,
            'user_id' => 6,
        ]);
        Review::create([
            'contenido' => 'El peor producto',
            'calificacion' => 1,
            'producto_id' => 2,
            'user_id' => 6,
        ]);
    }
}
