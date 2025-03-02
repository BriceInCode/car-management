<?php

namespace App\Models;

use App\Enum\DriversType;
use App\Enum\EnginesType;
use App\Enum\FuelsType;
use App\Enum\StatusType;
use App\Enum\TransmissionsType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Car extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'serial_number',
        'brand',
        'model',
        'year',
        'drive_type',
        'color',
        'image',
        'price',
        'mileage',
        'fuel_type',
        'transmission',
        'engine',
        'seats',
        'doors',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    // Intégration d'énumérations pour certains champs
    protected $casts = [
        'drive_type' => DriversType::class,
        'transmission' => TransmissionsType::class,
        'fuel_type' => FuelsType::class,
        'engine' => EnginesType::class,
        'status' => StatusType::class,
    ];

    // Règles de validation
    public static $rules = [
        'serial_number' => 'required|unique:cars,serial_number',
        'brand' => 'required|string|max:255',
        'model' => 'required|string|max:255',
        'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
        'price' => 'required|numeric|min:0',
        'mileage' => 'required|integer|min:0',
        'status' => ['required', 'string', Rule::enum(StatusType::class)],
        'drive_type' => ['required', 'string', Rule::enum(DriversType::class)],
        'transmission' => ['required', 'string', Rule::enum(TransmissionsType::class)],
        'fuel_type' => ['required', 'string', Rule::enum(FuelsType::class)],
        'engine' => ['required', 'string', Rule::enum(EnginesType::class)],
        'image' => 'nullable|array',
        'image.*' => 'mimes:jpeg,png,jpg|max:4096', // Taille max 4 Mo par image
    ];

    // Messages personnalisés pour les validations
    public static $messages = [
        'serial_number.required' => 'Le numéro de série est requis.',
        'serial_number.unique' => 'Le numéro de série doit être unique.',
        'brand.required' => 'La marque est requise.',
        'brand.string' => 'La marque doit être une chaîne de caractères.',
        'brand.max' => 'La marque ne peut pas dépasser 255 caractères.',
        'model.required' => 'Le modèle est requis.',
        'model.string' => 'Le modèle doit être une chaîne de caractères.',
        'model.max' => 'Le modèle ne peut pas dépasser 255 caractères.',
        'year.required' => 'L\'année est requise.',
        'year.integer' => 'L\'année doit être un entier.',
        'year.min' => 'L\'année doit être supérieure ou égale à 1886.',
        'year.max' => 'L\'année ne peut pas dépasser l\'année en cours.',
        'price.required' => 'Le prix est requis.',
        'price.numeric' => 'Le prix doit être un nombre.',
        'price.min' => 'Le prix doit être supérieur ou égal à 0.',
        'mileage.required' => 'Le kilométrage est requis.',
        'mileage.integer' => 'Le kilométrage doit être un nombre entier.',
        'mileage.min' => 'Le kilométrage doit être supérieur ou égal à 0.',
        'status.required' => 'Le statut est requis.',
        'status.string' => 'Le statut doit être une chaîne de caractères.',
        'status.in' => 'Le statut doit être valide.',
        'drive_type.required' => 'Le type de conduite est requis.',
        'drive_type.string' => 'Le type de conduite doit être une chaîne de caractères.',
        'drive_type.in' => 'Le type de conduite doit être valide.',
        'transmission.required' => 'Le type de transmission est requis.',
        'transmission.string' => 'Le type de transmission doit être une chaîne de caractères.',
        'transmission.in' => 'Le type de transmission doit être valide.',
        'fuel_type.required' => 'Le type de carburant est requis.',
        'fuel_type.string' => 'Le type de carburant doit être une chaîne de caractères.',
        'fuel_type.in' => 'Le type de carburant doit être valide.',
        'engine.required' => 'Le type de moteur est requis.',
        'engine.string' => 'Le type de moteur doit être une chaîne de caractères.',
        'engine.in' => 'Le type de moteur doit être valide.',
        'image.array' => 'L\'image doit être un tableau.',
        'image.*.mimes' => 'L\'image doit être au format jpeg, png ou jpg.',
        'image.*.max' => 'Chaque image ne peut pas dépasser 4 Mo.',
    ];

    // Relations avec l'utilisateur (création, mise à jour, suppression)
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
