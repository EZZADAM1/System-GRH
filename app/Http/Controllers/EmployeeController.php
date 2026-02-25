<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Department; 
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    // Affiche la liste des employés
    public function index()
    {
        // On récupère les employés, 10 par page, avec leur département
        $employees = Employee::with('department')->latest()->paginate(10);

        return view('employees.index', compact('employees'));
    }
    // ... dans la classe
    
    // 1. Affiche le formulaire de création
    public function create()
    {
        // On a besoin de la liste des départements pour le menu déroulant (select)
        $departments = Department::all();
        return view('employees.create', compact('departments'));
    }

    // 2. Sauvegarde le nouvel employé
    public function store(Request $request)
    {
        // A. Validation des données (Sécurité)
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'matricule' => 'required|string|unique:employees,matricule',
            'email_professional' => 'required|email|unique:employees,email_professional',
            'department_id' => 'required|exists:departments,id',
            'hired_at' => 'required|date',
            'salary' => 'nullable|numeric',
        ]);

        // B. Création en base de données
        Employee::create($validated);

        // C. Redirection avec message de succès
        return redirect()->route('employees.index')
                         ->with('success', 'Employé ajouté avec succès !');
    }

    // 3. Afficher le formulaire d'édition
    public function edit(Employee $employee)
    {
        $departments = Department::all();
        
        // On récupère tous les utilisateurs (pour le menu déroulant)
        $users = \App\Models\User::all(); 

        return view('employees.edit', compact('employee', 'departments', 'users'));
    }

    // 4. Enregistrer les modifications
    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'matricule' => 'required|string|unique:employees,matricule,' . $employee->id,
            'email_professional' => 'required|email|unique:employees,email_professional,' . $employee->id,
            'department_id' => 'required|exists:departments,id',
            'hired_at' => 'required|date',
            'salary' => 'nullable|numeric',
            
            // Nouvelle validation pour lier un utilisateur
            'user_id' => 'nullable|exists:users,id', 
        ]);

        $employee->update($validated);

        return redirect()->route('employees.index')
                        ->with('success', 'Informations (et liaison utilisateur) mises à jour !');
    }
    // 5. Supprimer un employé
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')
                         ->with('success', 'L\'employé a été supprimé de la base de données.');
    }
}
