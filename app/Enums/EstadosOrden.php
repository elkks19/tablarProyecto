<?php

namespace App\Enums;

enum EstadosOrden: string
{
    case PENDIENTE = 'pendiente';
    case PROCESANDO = 'procesando';
    case ENVIADO = 'enviado';
    case ENTREGADO = 'entregado';

    public static function all(): array
    {
        $cases = [];
        foreach (self::cases() as $case) {
            $cases[] = $case->value;
        }

        return $cases;
    }
}
