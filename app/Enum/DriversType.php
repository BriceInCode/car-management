<?php

namespace App\Enum;

enum DriversType : string
{
    case FWD = 'FWD';  // Transmission avant
    case RWD = 'RWD';  // Propulsion arrière
    case AWD = 'AWD';  // Transmission intégrale
}
