<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LeaveController extends Controller
{
    // Affiche la liste
    public function index()
{
    // On récupère l'utilisateur connecté proprement
    $user = Auth::user();

    // 1. Si c'est un ADMIN : Il voit tout
    if ($user->role === 'admin') {
        $leaves = Leave::with('employee')->latest()->paginate(10);
    } 
    // 2. Si c'est un EMPLOYÉ
    else {
        // On vérifie s'il a bien une fiche employé liée
        if ($user->employee) {
            $leaves = Leave::with('employee')
                        ->where('employee_id', $user->employee->id)
                        ->latest()
                        ->paginate(10);
        } else {
            // Si pas de fiche employé, liste vide (pour éviter le crash)
            $leaves = Leave::where('id', 0)->paginate(10);
        }
    }

    return view('leaves.index', compact('leaves'));
}

    // Affiche le formulaire (pour plus tard)
    public function create()
    {
        $employees = Employee::all();
        return view('leaves.create', compact('employees'));
    }

    // Enregistre la demande
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'type' => 'required|string',
            'reason' => 'nullable|string',
        ]);

        Leave::create($request->all());

        return redirect()->route('leaves.index')
                         ->with('success', 'Demande enregistrée !');
    }
    // Valider un congé
    public function approve(Leave $leave)
    {
        // Utilisation de la Façade Auth pour la propreté
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Accès interdit. Seul un administrateur peut valider.');
        }

        $leave->update(['status' => 'approved']);
        return back()->with('success', 'La demande de congé a été validée.');
    }

    // Refuser un congé
    public function reject(Leave $leave)
    {
        // Pareil ici
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Accès interdit.');
        }
        
        $leave->update(['status' => 'rejected']);
        return back()->with('success', 'La demande de congé a été refusée.');
    }
}