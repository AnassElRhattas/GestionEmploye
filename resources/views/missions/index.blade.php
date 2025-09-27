<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion des Missions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Formulaire de création de mission -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Nouvelle Mission</h3>
                    
                    <form id="mission-form" method="POST" action="{{ route('missions.store') }}" class="space-y-4">
                        @csrf
                        
                        <!-- Intitulé de la mission -->
                        <div>
                            <x-input-label for="title" :value="__('Nature de la mission')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        
                        <!-- Durée de la mission -->
                        <div>
                            <x-input-label for="duration_days" :value="__('Durée (jours)')" />
                            <x-text-input id="duration_days" class="block mt-1 w-full" type="number" name="duration_days" min="1" :value="old('duration_days')" required />
                            <x-input-error :messages="$errors->get('duration_days')" class="mt-2" />
                        </div>
                        
                        <!-- Entreprise -->
                        <div id="company-section">
                            <x-input-label for="company" :value="__('Entreprise')" />
                            <x-text-input id="company" class="block mt-1 w-full" type="text" name="company" :value="old('company')" required />
                            <x-input-error :messages="$errors->get('company')" class="mt-2" />
                        </div>
                        
                        <!-- Sélection des employés -->
                        <div id="employees-section">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-3">Employés disponibles</label>
                                
                                <!-- Barre de recherche -->
                                <div class="mb-4">
                                    <input type="text" id="employee-search" placeholder="Rechercher un employé..." 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                </div>
                                
                                <!-- Filtres -->
                                <div class="mb-4 flex flex-wrap gap-2">
                                    <select id="experience-filter" class="px-3 py-1 border border-gray-300 rounded-md text-sm">
                                        <option value="">Toute expérience</option>
                                        <option value="0-2">0-2 ans</option>
                                        <option value="3-5">3-5 ans</option>
                                        <option value="6-10">6-10 ans</option>
                                        <option value="10+">10+ ans</option>
                                    </select>
                                    <select id="speciality-filter" class="px-3 py-1 border border-gray-300 rounded-md text-sm">
                                        <option value="">Toutes spécialités</option>
                                        <option value="Agriculture">Agriculture</option>
                                        <option value="Élevage">Élevage</option>
                                        <option value="Horticulture">Horticulture</option>
                                        <option value="Mécanique agricole">Mécanique agricole</option>
                                    </select>
                                </div>
                                
                                <!-- Compteur d'employés sélectionnés -->
                                <div class="mb-3">
                                    <span id="selected-count" class="text-sm text-gray-600">0 employé(s) sélectionné(s)</span>
                                </div>
                                
                                <!-- Grille des employés -->
                                <div id="employees-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 max-h-96 overflow-y-auto border border-gray-200 rounded-lg p-4">
                                    @foreach($availableEmployees as $employee)
                                        <div class="employee-card bg-white border border-gray-200 rounded-lg p-4 cursor-pointer hover:shadow-md transition-all duration-200" 
                                             data-employee-id="{{ $employee->id }}"
                                             data-name="{{ strtolower($employee->nom . ' ' . $employee->prenom) }}"
                                             data-experience="{{ $employee->experience_annees ?? 0 }}"
                                             data-specialities="{{ is_array($employee->specialites) ? implode(',', $employee->specialites) : (is_string($employee->specialites) ? $employee->specialites : '') }}">
                                            
                                            <div class="flex items-start justify-between">
                                                <div class="flex-1">
                                                    <h4 class="font-medium text-gray-900">{{ $employee->nom }} {{ $employee->prenom }}</h4>
                                                    <p class="text-sm text-gray-500 mt-1">{{ $employee->age }} ans</p>
                                                    
                                                    @if($employee->experience_annees)
                                                        <p class="text-sm text-blue-600 mt-1">
                                                            <span class="inline-flex items-center">
                                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                                </svg>
                                                                {{ $employee->experience_annees }} ans d'expérience
                                                            </span>
                                                        </p>
                                                    @endif
                                                    
                                                    @if($employee->specialites)
                                                        <div class="mt-2">
                                                            @php
                                                                $specs = is_array($employee->specialites) ? $employee->specialites : json_decode($employee->specialites, true);
                                                            @endphp
                                                            @if(!empty($specs))
                                                                <div class="flex flex-wrap gap-1">
                                                                    @foreach(array_slice($specs, 0, 2) as $spec)
                                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                                            {{ $spec }}
                                                                        </span>
                                                                    @endforeach
                                                                    @if(count($specs) > 2)
                                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                                                            +{{ count($specs) - 2 }}
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>
                                                
                                                <!-- Checkbox de sélection -->
                                                <div class="ml-3">
                                                    <input type="checkbox" name="employees[]" value="{{ $employee->id }}" 
                                                           class="employee-checkbox w-5 h-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                
                                @if($availableEmployees->isEmpty())
                                    <div class="text-center py-8 text-gray-500">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun employé disponible</h3>
                                        <p class="mt-1 text-sm text-gray-500">Tous les employés sont actuellement assignés à des missions.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Bouton de validation -->
                        <div id="submit-section" class="pt-4">
                            <x-primary-button>
                                {{ __('Valider la mission') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Liste des missions existantes -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Missions</h3>
                    
                    @if($missions->isEmpty())
                        <p class="text-gray-500 text-center py-4">Aucune mission enregistrée.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nature</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Entreprise</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durée</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employés</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($missions as $mission)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $mission->title }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $mission->company }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                @if($mission->duration_days)
                                                    {{ $mission->duration_days }} jours
                                                @elseif($mission->start_date && $mission->end_date)
                                                    {{ $mission->start_date->format('d/m/Y') }} - {{ $mission->end_date->format('d/m/Y') }}
                                                @else
                                                    Non spécifiée
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $mission->status === 'en_cours' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                                    {{ $mission->status === 'en_cours' ? 'En cours' : 'Terminée' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <div class="flex flex-wrap gap-1">
                                                    @foreach($mission->employees as $employee)
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                            {{ $employee->nom }} {{ $employee->prenom }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                @if($mission->status === 'en_cours')
                                                    <a href="{{ route('missions.show', $mission) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Suivre l'avancement</a>
                                                    <form method="POST" action="{{ route('missions.update-status', $mission) }}" class="inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="terminee">
                                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Êtes-vous sûr de vouloir finaliser cette mission ?')">
                                                            Finaliser
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="text-gray-400">Mission terminée</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const employeeCards = document.querySelectorAll('.employee-card');
            const searchInput = document.getElementById('employee-search');
            const experienceFilter = document.getElementById('experience-filter');
            const specialityFilter = document.getElementById('speciality-filter');
            const selectedCount = document.getElementById('selected-count');
            
            // Fonction pour mettre à jour le compteur
            function updateSelectedCount() {
                const selectedCheckboxes = document.querySelectorAll('.employee-checkbox:checked');
                const count = selectedCheckboxes.length;
                selectedCount.textContent = `${count} employé(s) sélectionné(s)`;
            }
            
            // Fonction pour filtrer les employés
            function filterEmployees() {
                const searchTerm = searchInput.value.toLowerCase();
                const experienceValue = experienceFilter.value;
                const specialityValue = specialityFilter.value.toLowerCase();
                
                employeeCards.forEach(card => {
                    const name = card.dataset.name;
                    const experience = parseInt(card.dataset.experience);
                    const specialities = card.dataset.specialities.toLowerCase();
                    
                    let showCard = true;
                    
                    // Filtre par nom
                    if (searchTerm && !name.includes(searchTerm)) {
                        showCard = false;
                    }
                    
                    // Filtre par expérience
                    if (experienceValue) {
                        switch (experienceValue) {
                            case '0-2':
                                if (experience < 0 || experience > 2) showCard = false;
                                break;
                            case '3-5':
                                if (experience < 3 || experience > 5) showCard = false;
                                break;
                            case '6-10':
                                if (experience < 6 || experience > 10) showCard = false;
                                break;
                            case '10+':
                                if (experience < 10) showCard = false;
                                break;
                        }
                    }
                    
                    // Filtre par spécialité
                    if (specialityValue && !specialities.includes(specialityValue)) {
                        showCard = false;
                    }
                    
                    card.style.display = showCard ? 'block' : 'none';
                });
            }
            
            // Gestion de la sélection des employés
            employeeCards.forEach(card => {
                const checkbox = card.querySelector('.employee-checkbox');
                
                // Clic sur la carte pour sélectionner/désélectionner
                card.addEventListener('click', function(e) {
                    if (e.target.type !== 'checkbox') {
                        checkbox.checked = !checkbox.checked;
                        updateCardAppearance(card, checkbox.checked);
                        updateSelectedCount();
                    }
                });
                
                // Clic direct sur la checkbox
                checkbox.addEventListener('change', function() {
                    updateCardAppearance(card, this.checked);
                    updateSelectedCount();
                });
            });
            
            // Fonction pour mettre à jour l'apparence de la carte
            function updateCardAppearance(card, isSelected) {
                if (isSelected) {
                    card.classList.add('ring-2', 'ring-indigo-500', 'bg-indigo-50');
                    card.classList.remove('bg-white');
                } else {
                    card.classList.remove('ring-2', 'ring-indigo-500', 'bg-indigo-50');
                    card.classList.add('bg-white');
                }
            }
            
            // Événements de filtrage
            searchInput.addEventListener('input', filterEmployees);
            experienceFilter.addEventListener('change', filterEmployees);
            specialityFilter.addEventListener('change', filterEmployees);
            
            // Boutons de sélection rapide
            const employeesSection = document.getElementById('employees-section');
            const quickSelectDiv = document.createElement('div');
            quickSelectDiv.className = 'mb-4 flex gap-2';
            quickSelectDiv.innerHTML = `
                <button type="button" id="select-all" class="px-3 py-1 bg-indigo-600 text-white text-sm rounded-md hover:bg-indigo-700">
                    Tout sélectionner
                </button>
                <button type="button" id="deselect-all" class="px-3 py-1 bg-gray-600 text-white text-sm rounded-md hover:bg-gray-700">
                    Tout désélectionner
                </button>
            `;
            
            const employeesGrid = document.getElementById('employees-grid');
            employeesSection.insertBefore(quickSelectDiv, employeesGrid);
            
            // Fonctionnalité de sélection rapide
            document.getElementById('select-all').addEventListener('click', function() {
                const visibleCards = Array.from(employeeCards).filter(card => card.style.display !== 'none');
                visibleCards.forEach(card => {
                    const checkbox = card.querySelector('.employee-checkbox');
                    checkbox.checked = true;
                    updateCardAppearance(card, true);
                });
                updateSelectedCount();
            });
            
            document.getElementById('deselect-all').addEventListener('click', function() {
                employeeCards.forEach(card => {
                    const checkbox = card.querySelector('.employee-checkbox');
                    checkbox.checked = false;
                    updateCardAppearance(card, false);
                });
                updateSelectedCount();
            });
            
            // Validation du formulaire
            const form = document.getElementById('mission-form');
            form.addEventListener('submit', function(e) {
                const selectedEmployees = document.querySelectorAll('.employee-checkbox:checked');
                if (selectedEmployees.length === 0) {
                    e.preventDefault();
                    alert('Veuillez sélectionner au moins un employé pour cette mission.');
                    return false;
                }
            });
            
            // Initialisation du compteur
            updateSelectedCount();
        });
    </script>
    @endpush
</x-app-layout>