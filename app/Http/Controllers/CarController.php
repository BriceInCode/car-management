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

    // Lister toutes les voitures
    public function index()
    {
        return response()->json(['data' => Car::all()], 200);
    }
    
    // Afficher une voiture spécifique
    public function show($id)
    {
        $car = Car::findOrFail($id);
        return response()->json(['data' => $car], 200);
    }


}
