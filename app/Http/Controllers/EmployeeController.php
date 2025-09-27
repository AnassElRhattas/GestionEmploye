<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Employee::query();
        
        // Recherche par nom ou prénom
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('prenom', 'like', "%{$search}%");
            });
        }
        
        // Filtrage par disponibilité
        if ($request->has('disponible')) {
            $query->where('disponible', $request->disponible == 'true');
        }
        
        $employees = $query->latest()->paginate(10);
        
        if ($request->ajax()) {
            return view('employees.table', compact('employees'))->render();
        }
        
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specialites = [
            'Préparation du sol (labourage, bêchage, désherbage)',
            'Semis et plantation des plants ou graines',
            'Arrosage / irrigation',
            'Entretien et soins des cultures (taillage, élagage, fertilisation)',
            'Traitement phytosanitaire (pulvérisations, lutte contre les parasites et maladies)',
            'Récolte des produits (fruits, légumes, fleurs…)',
            'Tri, nettoyage et conditionnement des récoltes',
            'Transport interne des récoltes (ramassage, acheminement vers lieu de stockage)',
            'Entretien des équipements agricoles et des espaces (nettoyage, réparations simples)',
            'Chargement / déchargement des récoltes ou des intrants (semences, engrais, etc.)'
        ];
        
        $cultures = ['maraîchage', 'arboriculture', 'ornementale', 'élevage'];
        
        return view('employees.create', compact('specialites', 'cultures'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'age' => 'required|integer|min:18|max:100',
            'zone_rurale' => 'required|string|max:255',
            'experience_annees' => 'required|integer|min:0',
            'experience_cultures' => 'required|array',
            'specialites' => 'required|array',
        ]);
        
        // Conversion des tableaux en JSON
        $validated['experience_cultures'] = json_encode($request->experience_cultures);
        $validated['specialites'] = json_encode($request->specialites);
        
        Employee::create($validated);
        
        return redirect()->route('employees.index')
            ->with('success', 'Employé créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $specialites = [
            'Préparation du sol (labourage, bêchage, désherbage)',
            'Semis et plantation des plants ou graines',
            'Arrosage / irrigation',
            'Entretien et soins des cultures (taillage, élagage, fertilisation)',
            'Traitement phytosanitaire (pulvérisations, lutte contre les parasites et maladies)',
            'Récolte des produits (fruits, légumes, fleurs…)',
            'Tri, nettoyage et conditionnement des récoltes',
            'Transport interne des récoltes (ramassage, acheminement vers lieu de stockage)',
            'Entretien des équipements agricoles et des espaces (nettoyage, réparations simples)',
            'Chargement / déchargement des récoltes ou des intrants (semences, engrais, etc.)'
        ];
        
        $cultures = ['maraîchage', 'arboriculture', 'ornementale', 'élevage'];
        
        return view('employees.edit', compact('employee', 'specialites', 'cultures'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'age' => 'required|integer|min:18|max:100',
            'zone_rurale' => 'required|string|max:255',
            'experience_annees' => 'required|integer|min:0',
            'experience_cultures' => 'required|array',
            'specialites' => 'required|array',
            'disponible' => 'boolean',
        ]);
        
        // Conversion des tableaux en JSON
        $validated['experience_cultures'] = json_encode($request->experience_cultures);
        $validated['specialites'] = json_encode($request->specialites);
        $validated['disponible'] = $request->has('disponible');
        
        $employee->update($validated);
        
        return redirect()->route('employees.index')
            ->with('success', 'Employé mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        
        return redirect()->route('employees.index')
            ->with('success', 'Employé supprimé avec succès.');
    }
    
    /**
     * Toggle employee availability status.
     */
    public function toggleAvailability(Employee $employee)
    {
        $employee->disponible = !$employee->disponible;
        $employee->save();
        
        return response()->json(['status' => 'success', 'disponible' => $employee->disponible]);
    }
}
