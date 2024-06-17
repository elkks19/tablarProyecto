<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Producto;
use App\Models\Categoria;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos_tienen_categorias', function (Blueprint $table) {
            $table->foreignIdFor(Producto::class)->constrained('productos', 'id');
            $table->foreignIdFor(Categoria::class)->constrained('categorias', 'id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos_tienen_categorias');
    }
};
