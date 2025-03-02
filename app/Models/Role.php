<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
        'description', // Ajout du champ description
    ];

    // Règles de validation
    public static $rules = [
        'name' => 'required|string|max:255|unique:roles,name',
        'description' => 'nullable|string|max:500',
    ];

    // Messages personnalisés pour les validations
    public static $messages = [
        'name.required' => 'Le nom du rôle est obligatoire.',
        'name.string' => 'Le nom du rôle doit être une chaîne de caractères.',
        'name.max' => 'Le nom du rôle ne doit pas dépasser 255 caractères.',
        'name.unique' => 'Ce nom de rôle est déjà utilisé.',
        'description.string' => 'La description doit être une chaîne de caractères.',
        'description.max' => 'La description ne doit pas dépasser 500 caractères.',
    ];

    // Relations
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
