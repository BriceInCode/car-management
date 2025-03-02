<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name',
        'description', // Ajout du champ description
    ];

    // Règles de validation
    public static $rules = [
        'name' => 'required|string|max:255|unique:permissions,name',
        'description' => 'nullable|string|max:500',
    ];

    // Messages personnalisés pour les validations
    public static $messages = [
        'name.required' => 'Le nom de la permission est obligatoire.',
        'name.string' => 'Le nom de la permission doit être une chaîne de caractères.',
        'name.max' => 'Le nom de la permission ne doit pas dépasser 255 caractères.',
        'name.unique' => 'Ce nom de permission est déjà utilisé.',
        'description.string' => 'La description doit être une chaîne de caractères.',
        'description.max' => 'La description ne doit pas dépasser 500 caractères.',
    ];

    // Relations
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
