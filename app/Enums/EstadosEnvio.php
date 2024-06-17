<?php

namespace App\Enums;

enum EstadosEnvio : string
{
    case PENDIENTE = 'pendiente';
    case ENVIADO = 'enviado';
    case RECIBIDO = 'recibido';

    public static function all(): array
    {
        $cases = [];
        foreach (self::cases() as $case) {
            $cases[] = $case->value;
        }

        return $cases;
    }
}
