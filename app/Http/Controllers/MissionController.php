<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Mission;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    /**
     * Affiche la liste des missions
     */
    public function index()
    {
        $missions = Mission::with('employees')->latest()->get();
        
        // Récupérer les IDs des employés dans des missions en cours
        $employeesInActiveMissions = Mission::where('status', 'en_cours')
            ->with('employees')
            ->get()
            ->pluck('employees')
            ->flatten()
            ->pluck('id')
            ->unique()
            ->toArray();
            
        // Mettre à jour le statut de disponibilité des employés
        Employee::whereIn('id', $employeesInActiveMissions)->update(['disponible' => false]);
        Employee::whereNotIn('id', $employeesInActiveMissions)->update(['disponible' => true]);
        
        // Récupérer les employés disponibles
        $availableEmployees = Employee::whereNotIn('id', $employeesInActiveMissions)->get();
        
        return view('missions.index', compact('missions', 'availableEmployees'));
    }

    /**
     * Enregistre une nouvelle mission
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'employees' => 'required|array',
            'employees.*' => 'exists:employees,id',
        ]);

        // Déterminer la durée (soit en jours, soit par dates)
        if ($request->has('duration_days') && $request->duration_days) {
            $durationData = [
                'duration_days' => $request->duration_days,
            ];
        } else {
            $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);

            $durationData = [
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ];
        }

        // Créer la mission
        $mission = Mission::create(array_merge(
            $request->only('title', 'company', 'notes'),
            $durationData,
            ['status' => 'en_cours']
        ));

        // Associer les employés à la mission
        $mission->employees()->attach($request->employees);

        // Mettre à jour la disponibilité des employés - Forcer à false
        Employee::whereIn('id', $request->employees)->update(['disponible' => false]);

        return redirect()
            ->route('missions.index')
            ->with('success', 'Mission créée avec succès.');
    }

    /**
     * Met à jour le statut d'une mission
     */
    public function updateStatus(Request $request, Mission $mission)
    {
        $request->validate([
            'status' => 'required|in:en_cours,terminee',
        ]);

        $mission->update(['status' => $request->status]);

        // Si la mission est terminée, libérer les employés
        if ($request->status === 'terminee') {
            $employeeIds = $mission->employees->pluck('id')->toArray();
            Employee::whereIn('id', $employeeIds)->update(['disponible' => true]);
        }

        return redirect()
            ->route('missions.index')
            ->with('success', 'Statut de la mission mis à jour.');
    }

    /**
     * Récupère la liste des employés disponibles au format JSON
     */
    public function getAvailableEmployees()
    {
        // Récupérer uniquement les employés qui sont réellement disponibles
        // (pas dans une mission en cours)
        $employeesInActiveMissions = Mission::where('status', 'en_cours')
            ->with('employees')
            ->get()
            ->pluck('employees')
            ->flatten()
            ->pluck('id')
            ->unique()
            ->toArray();
            
        $employees = Employee::whereNotIn('id', $employeesInActiveMissions)
            ->orWhere('disponible', true)
            ->get();
            
        // Mettre à jour la disponibilité pour s'assurer qu'elle est correcte
        foreach ($employees as $employee) {
            if (in_array($employee->id, $employeesInActiveMissions)) {
                $employee->disponible = false;
                $employee->save();
            }
        }
        
        // Ne retourner que les employés réellement disponibles
        $availableEmployees = $employees->filter(function($employee) use ($employeesInActiveMissions) {
            return !in_array($employee->id, $employeesInActiveMissions);
        });
        
        return response()->json($availableEmployees->values());
    }

    /**
     * Affiche les détails d'une mission spécifique
     */
    public function show(Mission $mission)
    {
        return view('missions.show', compact('mission'));
    }
    
    /**
     * Génère un PDF du cahier de charge de la mission
     */
    public function generatePdf(Mission $mission)
    {
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('missions.mission-pdf', compact('mission'));
        return $pdf->download('cahier-de-charge-' . $mission->id . '.pdf');
    }
}
