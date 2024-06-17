<?php

namespace App\Enums;

enum EstadosPago : string
{
    case PROCESANDO = 'procesando';
    case PENDIENTE = 'pendiente';
    case ACEPTADO = 'aceptado';

    public static function all(): array
    {
        $cases = [];
        foreach (self::cases() as $case) {
            $cases[] = $case->value;
        }

        return $cases;
    }
}
