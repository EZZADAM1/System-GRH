<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Leave;
use Illuminate\Support\Facades\Auth; 

class DashboardController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        
        $user = Auth::user(); 

        // SCÉNARIO 1 : C'est un ADMIN
        if ($user->role === 'admin') {
            $stats = [
                'label1' => 'Total Employés',
                'value1' => \App\Models\Employee::count(),
                
                'label2' => 'Congés en attente (Global)',
                'value2' => \App\Models\Leave::where('status', 'pending')->count(),
                
                'label3' => 'Départements',
                'value3' => \App\Models\Department::count(),
                
                'label4' => 'Masse Salariale',
                'value4' => number_format(\App\Models\Employee::sum('salary'), 2) . ' DH',
                
                'is_admin' => true
            ];
        } 
        // SCÉNARIO 2 : C'est un EMPLOYÉ
        else {
            
            $employeeId = $user->employee?->id ?? 0;

            $stats = [
                'label1' => 'Mes jours posés',
                'value1' => \App\Models\Leave::where('employee_id', $employeeId)->count(),
                
                'label2' => 'Mes demandes en attente',
                'value2' => \App\Models\Leave::where('employee_id', $employeeId)->where('status', 'pending')->count(),
                
                'label3' => 'Mon Département',
                'value3' => $user->employee?->department?->name ?? 'Non assigné',
                
                'label4' => 'Mon Salaire',
                'value4' => number_format($user->employee?->salary ?? 0, 2) . ' DH',
                
                'is_admin' => false
            ];
        }

        return view('dashboard', compact('stats'));
    }
}