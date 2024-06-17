<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Divisa;
use App\Models\MetodoPago;

use App\Enums\EstadosPago;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->float('monto', 2);
            $table->dateTime('fechaPago')->nullable();
            $table->enum('estado', EstadosPago::all())->default(EstadosPago::PENDIENTE->value);
            $table->foreignId('divisa_id')->nullable()->constrained('divisas', 'id');
            $table->foreignId('metodo_de_pago_id')->nullable()->constrained('metodos_de_pago', 'id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
