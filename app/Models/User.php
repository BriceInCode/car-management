<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id', // Ajout de la clé étrangère pour le rôle
        'phone',
        'address',
        'image',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Règles de validation
    public static $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        'phone' => [
            'required',
            'string',
            'size:12',
            'regex:/^2376(20\d{6}|21\d{6}|22[05]\d{6}|50\d{6}|51\d{6}|52\d{6}|53\d{6}|54[05-9]\d{6}|55\d{6}|56\d{6}|57\d{6}|58\d{6}|59\d{6}|80\d{6}|81\d{6}|82\d{6}|83\d{6}|85\d{6}|86\d{6}|87\d{6}|88[0-8]\d{6}|8890\d{5}|8895\d{5}|88960\d{4}|88964\d{4})$/'
        ],
        'address' => 'nullable|string|max:500',
        'image' => 'nullable|mimes:jpeg,png,jpg|max:4096', // Taille max 4 Mo (4096 Ko)
        'status' => 'required|in:actif,inactif',
    ];

    // Messages personnalisés pour les validations
    public static $messages = [
        'name.required' => 'Le nom est obligatoire.',
        'name.max' => 'Le nom ne doit pas dépasser 255 caractères.',
        'email.required' => 'L\'adresse email est obligatoire.',
        'email.email' => 'L\'adresse email doit être valide.',
        'email.max' => 'L\'adresse email ne doit pas dépasser 255 caractères.',
        'email.unique' => 'Cette adresse email est déjà utilisée.',
        'password.required' => 'Le mot de passe est obligatoire.',
        'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
        'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
    ];

    // Relations
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function carsCreated()
    {
        return $this->hasMany(Car::class, 'created_by');
    }

    public function carsUpdated()
    {
        return $this->hasMany(Car::class, 'updated_by');
    }

    public function carsDeleted()
    {
        return $this->hasMany(Car::class, 'deleted_by');
    }
}
