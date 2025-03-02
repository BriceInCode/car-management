<?php

namespace App\Enum;

enum EnginesType: string
{
    case V4 = 'V4';       // Moteur 4 cylindres
    case V6 = 'V6';       // Moteur 6 cylindres
    case V8 = 'V8';       // Moteur 8 cylindres
    case Electric = 'Electric'; // Moteur électrique
    case Hybrid = 'Hybrid';     // Moteur hybride
}
