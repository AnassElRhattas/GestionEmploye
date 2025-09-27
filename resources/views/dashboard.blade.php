<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Statistiques') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-t-4 border-green-600">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold text-green-700 mb-6 flex items-center">
                        <svg class="h-8 w-8 text-green-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        Statistiques des employés
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Carte du nombre total d'employés -->
                        <div class="bg-gradient-to-br from-green-50 to-green-100 overflow-hidden shadow-lg rounded-lg border border-green-200 transform transition-transform duration-300 hover:scale-105">
                            <div class="px-4 py-5 sm:p-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-gradient-to-r from-green-500 to-green-600 rounded-md p-3 shadow-md">
                                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-600 truncate">
                                                Total des employés
                                            </dt>
                                            <dd>
                                                <div class="text-3xl font-bold text-gray-900">
                                                    {{ \App\Models\Employee::count() }}
                                                </div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-4 sm:px-6 border-t border-green-100">
                                <div class="text-sm">
                                    <a href="{{ route('employees.index') }}" class="font-medium text-green-600 hover:text-green-800 flex items-center justify-between">
                                        <span>Voir tous les employés</span>
                                        <svg class="h-4 w-4 ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Carte des employés disponibles -->
                        <div class="bg-gradient-to-br from-green-50 to-green-100 overflow-hidden shadow-lg rounded-lg border border-green-200 transform transition-transform duration-300 hover:scale-105">
                            <div class="px-4 py-5 sm:p-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-gradient-to-r from-green-500 to-green-600 rounded-md p-3 shadow-md">
                                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-600 truncate">
                                                Employés disponibles
                                            </dt>
                                            <dd>
                                                <div class="text-3xl font-bold text-gray-900">
                                                    {{ \App\Models\Employee::where('disponible', true)->count() }}
                                                </div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-4 sm:px-6 border-t border-green-100">
                                <div class="text-sm">
                                    <a href="{{ route('employees.index') }}?disponible=true" class="font-medium text-green-600 hover:text-green-800 flex items-center justify-between">
                                        <span>Voir les disponibles</span>
                                        <svg class="h-4 w-4 ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Carte des employés non disponibles -->
                        <div class="bg-gradient-to-br from-red-50 to-red-100 overflow-hidden shadow-lg rounded-lg border border-red-200 transform transition-transform duration-300 hover:scale-105">
                            <div class="px-4 py-5 sm:p-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-gradient-to-r from-red-500 to-red-600 rounded-md p-3 shadow-md">
                                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-600 truncate">
                                                Employés non disponibles
                                            </dt>
                                            <dd>
                                                <div class="text-3xl font-bold text-gray-900">
                                                    {{ \App\Models\Employee::where('disponible', false)->count() }}
                                                </div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-4 sm:px-6 border-t border-red-100">
                                <div class="text-sm">
                                    <a href="{{ route('employees.index') }}?disponible=false" class="font-medium text-red-600 hover:text-red-800 flex items-center justify-between">
                                        <span>Voir les non disponibles</span>
                                        <svg class="h-4 w-4 ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Carte pour ajouter un employé -->
                        <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 overflow-hidden shadow-lg rounded-lg border border-yellow-200 transform transition-transform duration-300 hover:scale-105">
                            <div class="px-4 py-5 sm:p-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-md p-3 shadow-md">
                                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-600 truncate">
                                                Ajouter un employé
                                            </dt>
                                            <dd>
                                                <div class="text-lg font-medium text-gray-900">
                                                    <a href="{{ route('employees.create') }}" class="text-yellow-600 hover:text-yellow-800">
                                                        Créer un nouvel employé
                                                    </a>
                                                </div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8">
                        <!-- Statistiques par culture -->
                        <div>
                            <h3 class="text-xl font-semibold text-green-700 mb-4">Répartition par culture</h3>
                            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        @php
                                            $cultures = ['maraîchage', 'arboriculture', 'ornementale', 'élevage'];
                                            $employees = \App\Models\Employee::all();
                                            $cultureStats = [];
                                            
                                            foreach ($cultures as $culture) {
                                                $count = 0;
                                                foreach ($employees as $employee) {
                                                    $expCultures = is_array($employee->experience_cultures) 
                                                        ? $employee->experience_cultures 
                                                        : json_decode($employee->experience_cultures ?? '[]', true);
                                                    
                                                    if (is_array($expCultures) && in_array($culture, $expCultures)) {
                                                        $count++;
                                                    }
                                                }
                                                $cultureStats[$culture] = $count;
                                            }
                                        @endphp
                                        
                                        @foreach($cultures as $culture)
                                            <div class="bg-green-50 overflow-hidden shadow rounded-lg">
                                                <div class="px-4 py-5 sm:p-6">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                            </svg>
                                                        </div>
                                                        <div class="ml-5 w-0 flex-1">
                                                            <dl>
                                                                <dt class="text-sm font-medium text-gray-500 truncate">
                                                                    {{ ucfirst($culture) }}
                                                                </dt>
                                                                <dd>
                                                                    <div class="text-3xl font-bold text-gray-900">
                                                                        {{ $cultureStats[$culture] }}
                                                                    </div>
                                                                </dd>
                                                            </dl>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Statistiques par spécialité -->
                        <div>
                            <h3 class="text-xl font-semibold text-blue-700 mb-4">Répartition par spécialité</h3>
                            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="grid grid-cols-1 gap-4 max-h-96 overflow-y-auto pr-2">
                                        @php
                                            $specialitesList = [
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
                                            
                                            $specialiteStats = [];
                                            
                                            foreach ($specialitesList as $specialite) {
                                                $count = 0;
                                                foreach ($employees as $employee) {
                                                    $empSpecialites = is_array($employee->specialites) 
                                                        ? $employee->specialites 
                                                        : json_decode($employee->specialites ?? '[]', true);
                                                    
                                                    if (is_array($empSpecialites) && in_array($specialite, $empSpecialites)) {
                                                        $count++;
                                                    }
                                                }
                                                $specialiteStats[$specialite] = $count;
                                            }
                                            
                                            // Trier par nombre décroissant
                                            arsort($specialiteStats);
                                        @endphp
                                        
                                        @foreach($specialiteStats as $specialite => $count)
                                            <div class="bg-blue-50 overflow-hidden shadow rounded-lg">
                                                <div class="px-4 py-4 sm:p-4">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 bg-blue-500 rounded-md p-2">
                                                            <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                            </svg>
                                                        </div>
                                                        <div class="ml-4 flex-1">
                                                            <div class="flex justify-between items-center">
                                                                <span class="text-sm font-medium text-gray-700">
                                                                    {{ Str::limit($specialite, 50) }}
                                                                </span>
                                                                <span class="text-xl font-bold text-gray-900 ml-2">
                                                                    {{ $count }}
                                                                </span>
                                                            </div>
                                                            <div class="mt-1 w-full bg-gray-200 rounded-full h-2">
                                                                <div class="bg-blue-600 h-2 rounded-full" style="width: {{ ($count / $employees->count()) * 100 }}%"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
