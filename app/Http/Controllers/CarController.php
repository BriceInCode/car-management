<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    // Règles de validation pour une voiture
    private function validateCar(Request $request)
    {
        return Validator::make($request->all(), Car::$rules, Car::$messages);
    }

    
}
