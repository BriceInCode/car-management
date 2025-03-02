<?php

namespace App\Enum;

enum FuelsType: string
{
    case Petrol = 'Petrol';      // Essence
    case Diesel = 'Diesel';      // Diesel
    case Hybrid = 'Hybrid';      // Hybride
    case Electric = 'Electric';  // Électrique
}
