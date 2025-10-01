<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Mission;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Affiche le tableau de bord avec toutes les statistiques
     */
    public function index()
    {
        // Statistiques générales
        $totalEmployees = Employee::count();
        $availableEmployees = Employee::where('disponible', true)->count();
        $busyEmployees = Employee::where('disponible', false)->count();
        
        $totalMissions = Mission::count();
        $activeMissions = Mission::where('status', 'en_cours')->count();
        $completedMissions = Mission::where('status', 'terminee')->count();
        
        // Calcul des taux
        $occupationRate = $totalEmployees > 0 ? round(($busyEmployees / $totalEmployees) * 100) : 0;
        $completionRate = $totalMissions > 0 ? round(($completedMissions / $totalMissions) * 100) : 0;
        
        // Statistiques par zone
        $employeesByZone = Employee::selectRaw('zone_rurale, COUNT(*) as count, SUM(CASE WHEN disponible = 1 THEN 1 ELSE 0 END) as available_count')
            ->groupBy('zone_rurale')
            ->orderBy('count', 'desc')
            ->get();
        
        // Missions récentes
        $recentMissions = Mission::with('employees')->latest()->take(5)->get();
        
        // Employés récemment ajoutés
        $recentEmployees = Employee::latest()->take(5)->get();
        
        // Statistiques par spécialités
        $specialites = [
            'Préparation du sol' => 0,
            'Semis et plantation' => 0,
            'Arrosage / irrigation' => 0,
            'Entretien et soins' => 0,
            'Traitement phytosanitaire' => 0
        ];
        
        $employees = Employee::all();
        foreach ($employees as $employee) {
            $empSpecialites = is_array($employee->specialites) ? $employee->specialites : json_decode($employee->specialites, true);
            if (is_array($empSpecialites)) {
                foreach ($empSpecialites as $spec) {
                    foreach ($specialites as $key => $count) {
                        if (strpos($spec, $key) !== false) {
                            $specialites[$key]++;
                            break;
                        }
                    }
                }
            }
        }
        
        // Données pour le graphique des missions par mois
        $currentYear = date('Y');
        $allLabels = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
        
        $missionsEnCours = array_fill(0, 12, 0);
        $missionsTerminees = array_fill(0, 12, 0);
        
        $missions = Mission::whereYear('created_at', $currentYear)->get();
        
        foreach ($missions as $mission) {
            $month = $mission->created_at->format('n') - 1; // 0-indexed month
            if ($mission->status === 'en_cours') {
                $missionsEnCours[$month]++;
            } else {
                $missionsTerminees[$month]++;
            }
        }
        
        return view('dashboard', compact(
            'totalEmployees',
            'availableEmployees',
            'busyEmployees',
            'totalMissions',
            'activeMissions',
            'completedMissions',
            'occupationRate',
            'completionRate',
            'employeesByZone',
            'recentMissions',
            'recentEmployees',
            'specialites',
            'employees',
            'allLabels',
            'missionsEnCours',
            'missionsTerminees'
        ));
    }
}