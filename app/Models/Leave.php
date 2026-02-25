<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Indispensable pour gérer les dates correctement
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // Une demande appartient à un employé
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}