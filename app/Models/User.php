<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Les attributs qui peuvent être remplis via un formulaire.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // <--- Important pour l'admin/employé
    ];

    /**
     * Les attributs cachés.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Les casts (conversion de types).
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // =========================================================
    // Cette fonction permet de faire $user->employee
    // =========================================================
    public function employee()
    {
        // Un User "possède une" fiche Employee
        return $this->hasOne(Employee::class);
    }
}