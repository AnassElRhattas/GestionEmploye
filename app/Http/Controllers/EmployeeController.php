<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\CustomChoice;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Employee::query();
        
        // Recherche par nom ou prénom
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('prenom', 'like', "%{$search}%");
            });
        }
        
        // Filtrage par disponibilité
        if ($request->filled('disponible')) {
            if ($request->disponible === 'true') {
                $query->where('disponible', true);
            } elseif ($request->disponible === 'false') {
                $query->where('disponible', false);
            }
        }
        
        $employees = $query->latest()->paginate(10);
        
        if ($request->ajax()) {
            return view('employees._table', compact('employees'))->render();
        }
        
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $defaultSpecialites = [
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
        
        $defaultCultures = ['maraîchage', 'arboriculture', 'ornementale', 'élevage'];
        
        // Charger les choix personnalisés depuis la base
        $customCultures = CustomChoice::cultures()->orderBy('value')->pluck('value')->toArray();
        $customSpecialites = CustomChoice::specialites()->orderBy('value')->pluck('value')->toArray();
        
        // Fusionner et dédupliquer
        $specialites = array_values(array_unique(array_merge($defaultSpecialites, $customSpecialites)));
        $cultures = array_values(array_unique(array_merge($defaultCultures, $customCultures)));
        
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
            'telephone' => 'nullable|string|max:20',
            'identifiant' => 'nullable|string|max:50|unique:employees,identifiant',
            'experience_annees' => 'required|integer|min:0',
            'experience_cultures' => 'required|array',
            'specialites' => 'required|array',
            'other_culture' => 'nullable|string|max:255',
            'other_specialite' => 'nullable|string|max:255',
            'evaluation_stars' => 'nullable|integer|min:0|max:5',
            'evaluation_remark' => 'nullable|string',
        ]);
        
        // Gérer les ajouts personnalisés (Autre)
        $experienceCultures = $request->experience_cultures ?? [];
        $specialites = $request->specialites ?? [];
        
        if ($request->filled('other_culture')) {
            $newCulture = trim($request->input('other_culture'));
            if ($newCulture !== '') {
                // Sauvegarder comme option permanente si inexistante
                CustomChoice::firstOrCreate([
                    'type' => 'culture',
                    'value' => $newCulture,
                ]);
                // Ajouter à la sélection de cet employé
                if (!in_array($newCulture, $experienceCultures, true)) {
                    $experienceCultures[] = $newCulture;
                }
            }
        }
        
        if ($request->filled('other_specialite')) {
            $newSpecialite = trim($request->input('other_specialite'));
            if ($newSpecialite !== '') {
                CustomChoice::firstOrCreate([
                    'type' => 'specialite',
                    'value' => $newSpecialite,
                ]);
                if (!in_array($newSpecialite, $specialites, true)) {
                    $specialites[] = $newSpecialite;
                }
            }
        }
        
        // Conversion des tableaux en JSON
        $validated['experience_cultures'] = json_encode($experienceCultures);
        $validated['specialites'] = json_encode($specialites);
        
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
        $defaultSpecialites = [
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
        
        $defaultCultures = ['maraîchage', 'arboriculture', 'ornementale', 'élevage'];
        
        $customCultures = CustomChoice::cultures()->orderBy('value')->pluck('value')->toArray();
        $customSpecialites = CustomChoice::specialites()->orderBy('value')->pluck('value')->toArray();
        
        $specialites = array_values(array_unique(array_merge($defaultSpecialites, $customSpecialites)));
        $cultures = array_values(array_unique(array_merge($defaultCultures, $customCultures)));
        
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
            'telephone' => 'nullable|string|max:20',
            'identifiant' => 'nullable|string|max:50|unique:employees,identifiant,' . $employee->id,
            'experience_annees' => 'required|integer|min:0',
            'experience_cultures' => 'required|array',
            'specialites' => 'required|array',
            'disponible' => 'boolean',
            'other_culture' => 'nullable|string|max:255',
            'other_specialite' => 'nullable|string|max:255',
            'evaluation_stars' => 'nullable|integer|min:0|max:5',
            'evaluation_remark' => 'nullable|string',
        ]);
        
        $experienceCultures = $request->experience_cultures ?? [];
        $specialites = $request->specialites ?? [];
        
        if ($request->filled('other_culture')) {
            $newCulture = trim($request->input('other_culture'));
            if ($newCulture !== '') {
                CustomChoice::firstOrCreate([
                    'type' => 'culture',
                    'value' => $newCulture,
                ]);
                if (!in_array($newCulture, $experienceCultures, true)) {
                    $experienceCultures[] = $newCulture;
                }
            }
        }
        
        if ($request->filled('other_specialite')) {
            $newSpecialite = trim($request->input('other_specialite'));
            if ($newSpecialite !== '') {
                CustomChoice::firstOrCreate([
                    'type' => 'specialite',
                    'value' => $newSpecialite,
                ]);
                if (!in_array($newSpecialite, $specialites, true)) {
                    $specialites[] = $newSpecialite;
                }
            }
        }
        
        // Conversion des tableaux en JSON
        $validated['experience_cultures'] = json_encode($experienceCultures);
        $validated['specialites'] = json_encode($specialites);
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
    
    /**
     * Generate PDF for employee.
     */
    public function generatePDF(Employee $employee)
    {
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('employees.pdf', compact('employee'));
        return $pdf->download('employe-'.$employee->nom.'-'.$employee->prenom.'.pdf');
    }
}
