<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    // Ajouter une nouvelle voiture
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Car::$rules, Car::$messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Créer la voiture et assigner les informations de l'utilisateur connecté
        $car = new Car($request->all());
        $car->created_by = Auth::id();
        $car->updated_by = Auth::id();
        $car->save();

        return response()->json(['data' => $car, 'message' => 'Voiture créée avec succès'], 201);
    }

    // Mettre à jour une voiture existante
    public function update(Request $request, $id)
    {
        $car = Car::findOrFail($id);

        $validator = Validator::make($request->all(), Car::$rules, Car::$messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Mettre à jour la voiture et assigner les informations de l'utilisateur connecté
        $car->update($request->all());
        $car->updated_by = Auth::id();
        $car->save();

        return response()->json(['data' => $car, 'message' => 'Voiture mise à jour avec succès'], 200);
    }

    // Supprimer une voiture (soft delete)
    public function destroy($id)
    {
        $car = Car::findOrFail($id);

        $car->deleted_by = Auth::id();  // Utilisateur qui supprime la voiture
        $car->delete();

        return response()->json(['message' => 'Voiture supprimée avec succès'], 200);
    }

    // Restaurer une voiture supprimée (soft delete)
    public function restore($id)
    {
        $car = Car::withTrashed()->findOrFail($id);

        $car->restore();

        return response()->json(['data' => $car, 'message' => 'Voiture restaurée avec succès'], 200);
    }


}
