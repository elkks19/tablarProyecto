<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enums\EstadosEnvio;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('envios', function (Blueprint $table) {
            $table->id();
            $table->string('direccion', 120);
            $table->dateTime('fechaEnvio')->nullable();
            $table->dateTime('fechaRecepcion')->nullable();
            $table->enum('estado', EstadosEnvio::all())->default(EstadosEnvio::PENDIENTE->value);
            $table->float('precio', 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('envios');
    }
};
