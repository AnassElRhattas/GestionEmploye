<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Cartes de statistiques -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <!-- Nombre total d'employés -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-indigo-500 bg-opacity-75">
                                <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-500 text-sm">Employés</p>
                                <p class="text-3xl font-semibold text-gray-700">{{ \App\Models\Employee::count() }}</p>
                            </div>
                        </div>
                        <div class="mt-2">
                            <p class="text-sm text-gray-600">Dont {{ \App\Models\Employee::where('disponible', true)->count() }} disponibles</p>
                        </div>
                    </div>
                </div>

                <!-- Nombre total de missions -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-500 bg-opacity-75">
                                <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-500 text-sm">Missions</p>
                                <p class="text-3xl font-semibold text-gray-700">{{ \App\Models\Mission::count() }}</p>
                            </div>
                        </div>
                        <div class="mt-2">
                            <p class="text-sm text-gray-600">Dont {{ \App\Models\Mission::where('status', 'en_cours')->count() }} en cours</p>
                        </div>
                    </div>
                </div>

                <!-- Taux d'occupation -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-500 bg-opacity-75">
                                <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-500 text-sm">Taux d'occupation</p>
                                @php
                                    $totalEmployees = \App\Models\Employee::count();
                                    $busyEmployees = \App\Models\Employee::where('disponible', false)->count();
                                    $occupationRate = $totalEmployees > 0 ? round(($busyEmployees / $totalEmployees) * 100) : 0;
                                @endphp
                                <p class="text-3xl font-semibold text-gray-700">{{ $occupationRate }}%</p>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-yellow-500 h-2.5 rounded-full" style="width: {{ $occupationRate }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Missions terminées -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-500 bg-opacity-75">
                                <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-500 text-sm">Missions terminées</p>
                                <p class="text-3xl font-semibold text-gray-700">{{ \App\Models\Mission::where('status', 'terminee')->count() }}</p>
                            </div>
                        </div>
                        <div class="mt-2">
                            @php
                                $totalMissions = \App\Models\Mission::count();
                                $completedMissions = \App\Models\Mission::where('status', 'terminee')->count();
                                $completionRate = $totalMissions > 0 ? round(($completedMissions / $totalMissions) * 100) : 0;
                            @endphp
                            <p class="text-sm text-gray-600">{{ $completionRate }}% du total</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Graphiques et tableaux -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Missions récentes -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Missions récentes</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Entreprise</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employés</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach(\App\Models\Mission::with('employees')->latest()->take(5)->get() as $mission)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $mission->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $mission->company }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $mission->status == 'en_cours' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                                {{ $mission->status == 'en_cours' ? 'En cours' : 'Terminée' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $mission->employees->count() }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('missions.index') }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">Voir toutes les missions →</a>
                        </div>
                    </div>
                </div>

                <!-- Employés récemment ajoutés -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Employés récemment ajoutés</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Expérience</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Disponibilité</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach(\App\Models\Employee::latest()->take(5)->get() as $employee)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="ml-0">
                                                    <div class="text-sm font-medium text-gray-900">{{ $employee->nom }} {{ $employee->prenom }}</div>
                                                    <div class="text-sm text-gray-500">{{ $employee->zone_rurale }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $employee->experience_annees }} ans</div>
                                            <div class="text-sm text-gray-500">
                                                @php
                                                    $cultures = is_array($employee->experience_cultures) ? $employee->experience_cultures : json_decode($employee->experience_cultures, true);
                                                    echo implode(', ', array_slice($cultures, 0, 2));
                                                    if (count($cultures) > 2) echo '...';
                                                @endphp
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $employee->disponible ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $employee->disponible ? 'Disponible' : 'Occupé' }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('employees.index') }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">Voir tous les employés →</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filtrage par date et graphique de tendance des missions -->
            <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4 md:mb-0">Tendance des missions</h3>
                        <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
                            <div>
                                <label for="date-debut" class="block text-sm font-medium text-gray-700">Date de début</label>
                                <input type="date" id="date-debut" name="date-debut" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                            <div>
                                <label for="date-fin" class="block text-sm font-medium text-gray-700">Date de fin</label>
                                <input type="date" id="date-fin" name="date-fin" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                            <div class="self-end mt-1 sm:mt-0">
                                <button type="button" id="filter-button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Filtrer
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="w-full h-64">
                        <canvas id="missionsChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Statistiques par spécialités -->
            <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Répartition des employés par spécialité</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                        @php
                            $specialites = [
                                'Préparation du sol' => 0,
                                'Semis et plantation' => 0,
                                'Arrosage / irrigation' => 0,
                                'Entretien et soins' => 0,
                                'Traitement phytosanitaire' => 0
                            ];
                            
                            $employees = \App\Models\Employee::all();
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
                        @endphp

                        @foreach($specialites as $specialite => $count)
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h4 class="text-sm font-medium text-gray-700">{{ $specialite }}</h4>
                            <p class="text-2xl font-bold text-indigo-600">{{ $count }}</p>
                            <div class="mt-2 w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ $employees->count() > 0 ? ($count / $employees->count()) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts pour les graphiques -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Données pour le graphique de tendance des missions
            const ctx = document.getElementById('missionsChart').getContext('2d');
            
            // Données réelles de la base de données
            @php
                $allLabels = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
                $currentYear = date('Y');
                
                // Initialiser les tableaux pour stocker les comptages par mois
                $missionsEnCours = array_fill(0, 12, 0);
                $missionsTerminees = array_fill(0, 12, 0);
                
                // Récupérer toutes les missions
                $missions = \App\Models\Mission::whereYear('created_at', $currentYear)->get();
                
                // Compter les missions par mois et par statut
                foreach ($missions as $mission) {
                    $month = $mission->created_at->format('n') - 1; // 0-indexed month
                    if ($mission->status === 'en_cours') {
                        $missionsEnCours[$month]++;
                    } else {
                        $missionsTerminees[$month]++;
                    }
                }
            @endphp
            
            // Convertir les données PHP en JavaScript
            const allLabels = @json($allLabels);
            const allMissionsEnCours = @json($missionsEnCours);
            const allMissionsTerminees = @json($missionsTerminees);
            
            // Initialiser avec les données de tous les mois
            let labels = allLabels;
            let missionsEnCours = allMissionsEnCours;
            let missionsTerminees = allMissionsTerminees;
            
            // Créer le graphique
            let missionsChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Missions en cours',
                            data: missionsEnCours,
                            borderColor: 'rgb(34, 197, 94)',
                            backgroundColor: 'rgba(34, 197, 94, 0.1)',
                            tension: 0.3,
                            fill: true
                        },
                        {
                            label: 'Missions terminées',
                            data: missionsTerminees,
                            borderColor: 'rgb(59, 130, 246)',
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            tension: 0.3,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Évolution des missions par mois'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Nombre de missions'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Mois'
                            }
                        }
                    }
                }
            });
            
            // Gérer le filtrage par date
            document.getElementById('filter-button').addEventListener('click', function() {
                const dateDebut = document.getElementById('date-debut').value;
                const dateFin = document.getElementById('date-fin').value;
                
                if (dateDebut && dateFin) {
                    // Convertir les dates en indices de mois (0-11)
                    const debutMois = new Date(dateDebut).getMonth();
                    const finMois = new Date(dateFin).getMonth();
                    
                    if (debutMois <= finMois) {
                        // Filtrer les données selon la plage de dates
                        labels = allLabels.slice(debutMois, finMois + 1);
                        missionsEnCours = allMissionsEnCours.slice(debutMois, finMois + 1);
                        missionsTerminees = allMissionsTerminees.slice(debutMois, finMois + 1);
                        
                        // Mettre à jour le graphique
                        missionsChart.data.labels = labels;
                        missionsChart.data.datasets[0].data = missionsEnCours;
                        missionsChart.data.datasets[1].data = missionsTerminees;
                        missionsChart.options.plugins.title.text = 'Évolution des missions de ' + allLabels[debutMois] + ' à ' + allLabels[finMois];
                        missionsChart.update();
                    } else {
                        showErrorAlert('La date de début doit être antérieure à la date de fin.');
                    }
                } else {
                    showErrorAlert('Veuillez sélectionner une date de début et une date de fin.');
                }
            });
        });
    </script>
</x-app-layout>
