<?php

namespace App\Observers;

use App\Models\Orden;
use App\Models\Pago;
use App\Models\Envio;

class OrdenObserver
{
    /**
     * Handle the Orden "created" event.
     */
    public function created(Orden $orden): void
    {
        $orden->codigo = 'ORD-' . $orden->created_at->format('Ymd') . '-' . $orden->id;
        $orden->save();
    }

    /**
     * Handle the Orden "updated" event.
     */
    public function updated(Orden $orden): void
    {
        //
    }

    /**
     * Handle the Orden "deleted" event.
     */
    public function deleted(Orden $orden): void
    {
        //
    }

    /**
     * Handle the Orden "restored" event.
     */
    public function restored(Orden $orden): void
    {
        //
    }

    /**
     * Handle the Orden "force deleted" event.
     */
    public function forceDeleted(Orden $orden): void
    {
        //
    }
}
