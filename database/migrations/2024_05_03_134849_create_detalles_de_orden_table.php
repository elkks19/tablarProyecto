<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Orden;
use App\Models\Producto;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detalles_de_orden', function (Blueprint $table) {
            $table->foreignIdFor(Orden::class)->constrained('ordenes', 'id');
            $table->foreignIdFor(Producto::class)->constrained('productos', 'id');
            $table->integer('cantidad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles_de_orden');
    }
};
