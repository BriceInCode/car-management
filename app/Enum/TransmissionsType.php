<?php

namespace App\Enum;

enum TransmissionsType: string
{
    case MANUAL = 'manual';
    case AUTOMATIC = 'automatic';
    case SEMI_AUTOMATIC = 'semi-automatic';
    case CVT = 'cvt'; // Transmission à variation continue
}
