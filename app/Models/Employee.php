<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    // Autorise le remplissage de tous les champs
    protected $guarded = [];

    // Cela transforme automatiquement les dates textes en objets Date (Carbon)
    protected $casts = [
        'hired_at' => 'datetime',
        'birth_date' => 'datetime', // Ajoutons aussi la date de naissance par sécurité
    ];

    // Relation inverse : L'employé appartient à un User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation : L'employé appartient à un Département
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
