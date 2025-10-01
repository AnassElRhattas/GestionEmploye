<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Gestion des Missions') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Onglets -->
            <div class="mb-6 border-b border-gray-200">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
                    <li class="mr-2">
                        <a href="#nouvelle-mission" class="inline-block p-4 border-b-2 border-blue-600 rounded-t-lg text-blue-600 active" aria-current="page">
                            <svg class="w-4 h-4 mr-1 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Nouvelle mission
                        </a>
                    </li>
                    <li class="mr-2">
                        <a href="#liste-missions" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">
                            <svg class="w-4 h-4 mr-1 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            Liste des missions
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Formulaire de création de mission -->
            <div id="nouvelle-mission" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center mb-6">
                        <div class="p-3 rounded-full bg-indigo-100 text-indigo-600 mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Créer une nouvelle mission</h3>
                    </div>
                    
                    <form id="mission-form" method="POST" action="{{ route('missions.store') }}" class="space-y-6">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Colonne gauche -->
                            <div class="space-y-6">
                                <!-- Intitulé de la mission -->
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h4 class="text-sm font-medium text-gray-700 mb-3">Informations générales</h4>
                                    
                                    <div class="mb-4">
                                        <x-input-label for="title" :value="__('Nature de la mission')" />
                                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus placeholder="Ex: Développement agricole" />
                                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                    </div>
                                    
                                    <!-- Entreprise -->
                                    <div id="company-section">
                                        <x-input-label for="company" :value="__('Entreprise cliente')" />
                                        <x-text-input id="company" class="block mt-1 w-full" type="text" name="company" :value="old('company')" required placeholder="Ex: Ferme Dupont" />
                                        <x-input-error :messages="$errors->get('company')" class="mt-2" />
                                    </div>
                                </div>
                                
                                <!-- Durée de la mission -->
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h4 class="text-sm font-medium text-gray-700 mb-3">Planification</h4>
                                    
                                    <div class="mb-4">
                                        <x-input-label for="duration_type" :value="__('Type de durée')" />
                                        <select id="duration_type" class="block mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                            <option value="days">Nombre de jours</option>
                                            <option value="dates">Dates spécifiques</option>
                                        </select>
                                    </div>
                                    
                                    <div id="days-duration" class="mb-4">
                                        <x-input-label for="duration_days" :value="__('Durée (jours)')" />
                                        <x-text-input id="duration_days" class="block mt-1 w-full" type="number" name="duration_days" min="1" :value="old('duration_days')" required />
                                        <x-input-error :messages="$errors->get('duration_days')" class="mt-2" />
                                    </div>
                                    
                                    <div id="dates-duration" class="hidden space-y-4">
                                        <div>
                                            <x-input-label for="start_date" :value="__('Date de début')" />
                                            <x-text-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" :value="old('start_date')" />
                                            <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                                        </div>
                                        <div>
                                            <x-input-label for="end_date" :value="__('Date de fin')" />
                                            <x-text-input id="end_date" class="block mt-1 w-full" type="date" name="end_date" :value="old('end_date')" />
                                            <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Notes et description -->
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <x-input-label for="notes" :value="__('Description et objectifs')" />
                                    <textarea id="notes" name="notes" rows="4" class="block mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" placeholder="Décrivez les objectifs et les détails de la mission...">{{ old('notes') }}</textarea>
                                    <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                                </div>
                            </div>
                            
                            <!-- Colonne droite - Sélection des employés -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div id="employees-section">
                                    <div class="mb-4">
                                        <h4 class="text-sm font-medium text-gray-700 mb-3 flex items-center">
                                            <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                            Employés disponibles
                                        </h4>
                                        
                                        <!-- Barre de recherche -->
                                        <div class="mb-4 relative">
                                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                                </svg>
                                            </div>
                                            <input type="text" id="employee-search" placeholder="Rechercher un employé..." 
                                                   class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
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
                                        <div class="mb-3 flex justify-between items-center">
                                            <span id="selected-count" class="text-sm font-medium px-2.5 py-0.5 rounded-full bg-blue-100 text-blue-800">0 employé(s) sélectionné(s)</span>
                                            <button type="button" id="clear-selection" class="text-xs text-gray-500 hover:text-gray-700">
                                                Effacer la sélection
                                            </button>
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
            <div id="liste-missions" class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-indigo-100 text-indigo-600 mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900">Liste des missions</h3>
                        </div>
                        
                        <!-- Filtres pour la liste des missions -->
                        <div class="flex space-x-2">
                            <select id="status-filter" class="px-3 py-1 border border-gray-300 rounded-md text-sm">
                                <option value="all">Tous les statuts</option>
                                <option value="en_cours">En cours</option>
                                <option value="terminee">Terminées</option>
                            </select>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" id="mission-search" placeholder="Rechercher..." 
                                       class="pl-10 pr-3 py-1 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>
                    </div>
                    
                    @if($missions->isEmpty())
                        <div class="text-center py-8 text-gray-500 bg-gray-50 rounded-lg">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Aucune mission enregistrée</h3>
                            <p class="mt-1 text-sm text-gray-500">Commencez par créer une nouvelle mission.</p>
                        </div>
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
                                <tbody class="bg-white divide-y divide-gray-200" id="missions-table-body">
                                    @foreach($missions as $mission)
                                        <tr class="mission-row" data-status="{{ $mission->status }}" data-title="{{ strtolower($mission->title) }}" data-company="{{ strtolower($mission->company) }}">
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
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $mission->status === 'en_cours' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
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
                                                    <div class="flex items-center space-x-2">
                                                        <a href="{{ route('missions.show', $mission) }}" class="inline-flex items-center px-3 py-1 bg-indigo-100 text-indigo-700 rounded-md hover:bg-indigo-200">
                                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                            </svg>
                                                            Suivre
                                                        </a>
                                                        <button onclick="openFinalizeModal({{ $mission->id }}, '{{ addslashes($mission->title) }}')" class="inline-flex items-center px-3 py-1 bg-green-100 text-green-700 rounded-md hover:bg-green-200">
                                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                            </svg>
                                                            Finaliser
                                                        </button>
                                                        <button onclick="openDeleteMissionModal({{ $mission->id }}, '{{ addslashes($mission->title) }}')" class="inline-flex items-center px-3 py-1 bg-red-100 text-red-700 rounded-md hover:bg-red-200">
                                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                            Supprimer
                                                        </button>
                                                    </div>
                                                @else
                                                    <div class="flex items-center space-x-2">
                                                        <a href="{{ route('missions.show', $mission) }}" class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200">
                                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                            </svg>
                                                            Détails
                                                        </a>
                                                        <button onclick="openDeleteMissionModal({{ $mission->id }}, '{{ addslashes($mission->title) }}')" class="inline-flex items-center px-3 py-1 bg-red-100 text-red-700 rounded-md hover:bg-red-200">
                                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                            Supprimer
                                                        </button>
                                                    </div>
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
            const clearSelection = document.getElementById('clear-selection');
            const durationType = document.getElementById('duration_type');
            const daysDuration = document.getElementById('days-duration');
            const datesDuration = document.getElementById('dates-duration');
            
            // Gestion des onglets
            const tabLinks = document.querySelectorAll('a[href^="#"]');
            tabLinks.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href').substring(1);
                    
                    // Cacher tous les contenus d'onglets
                    document.querySelectorAll('#nouvelle-mission, #liste-missions').forEach(content => {
                        content.style.display = 'none';
                    });
                    
                    // Afficher le contenu cible
                    document.getElementById(targetId).style.display = 'block';
                    
                    // Mettre à jour les classes des onglets
                    tabLinks.forEach(t => {
                        t.classList.remove('border-blue-600', 'text-blue-600');
                        t.classList.add('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300');
                    });
                    
                    this.classList.add('border-blue-600', 'text-blue-600');
                    this.classList.remove('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300');
                });
            });
            
            // Gestion du type de durée
            if (durationType) {
                durationType.addEventListener('change', function() {
                    if (this.value === 'days') {
                        daysDuration.classList.remove('hidden');
                        datesDuration.classList.add('hidden');
                    } else {
                        daysDuration.classList.add('hidden');
                        datesDuration.classList.remove('hidden');
                    }
                });
            }
            
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
            if (searchInput) searchInput.addEventListener('input', filterEmployees);
            if (experienceFilter) experienceFilter.addEventListener('change', filterEmployees);
            if (specialityFilter) specialityFilter.addEventListener('change', filterEmployees);
            
            // Effacer la sélection
            if (clearSelection) {
                clearSelection.addEventListener('click', function() {
                    employeeCards.forEach(card => {
                        const checkbox = card.querySelector('.employee-checkbox');
                        checkbox.checked = false;
                        updateCardAppearance(card, false);
                    });
                    updateSelectedCount();
                });
            }
            
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
            if (employeesSection && employeesGrid) {
                employeesSection.insertBefore(quickSelectDiv, employeesGrid);
            }
            
            // Fonctionnalité de sélection rapide
            document.getElementById('select-all')?.addEventListener('click', function() {
                const visibleCards = Array.from(employeeCards).filter(card => card.style.display !== 'none');
                visibleCards.forEach(card => {
                    const checkbox = card.querySelector('.employee-checkbox');
                    checkbox.checked = true;
                    updateCardAppearance(card, true);
                });
                updateSelectedCount();
            });
            
            document.getElementById('deselect-all')?.addEventListener('click', function() {
                employeeCards.forEach(card => {
                    const checkbox = card.querySelector('.employee-checkbox');
                    checkbox.checked = false;
                    updateCardAppearance(card, false);
                });
                updateSelectedCount();
            });
            
            // Filtrage des missions
            const statusFilter = document.getElementById('status-filter');
            const missionSearch = document.getElementById('mission-search');
            const missionRows = document.querySelectorAll('.mission-row');
            
            function filterMissions() {
                const statusValue = statusFilter ? statusFilter.value : 'all';
                const searchValue = missionSearch ? missionSearch.value.toLowerCase().trim() : '';
                
                missionRows.forEach(row => {
                    const status = row.dataset.status;
                    const title = row.dataset.title;
                    const company = row.dataset.company;
                    
                    const matchesStatus = statusValue === 'all' || status === statusValue;
                    const matchesSearch = searchValue === '' || 
                                         title.includes(searchValue) || 
                                         company.includes(searchValue);
                    
                    row.style.display = (matchesStatus && matchesSearch) ? '' : 'none';
                });
            }
            
            if (statusFilter) statusFilter.addEventListener('change', filterMissions);
            if (missionSearch) missionSearch.addEventListener('input', filterMissions);
            
            // Gestion du type de durée (jours ou dates spécifiques)
            const durationDaysInput = document.getElementById('duration_days');
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');
            
            if (durationType) {
                durationType.addEventListener('change', function() {
                    if (this.value === 'days') {
                        daysDuration.classList.remove('hidden');
                        datesDuration.classList.add('hidden');
                        durationDaysInput.setAttribute('required', '');
                        startDateInput.removeAttribute('required');
                        endDateInput.removeAttribute('required');
                    } else {
                        daysDuration.classList.add('hidden');
                        datesDuration.classList.remove('hidden');
                        durationDaysInput.removeAttribute('required');
                        startDateInput.setAttribute('required', '');
                        endDateInput.setAttribute('required', '');
                    }
                });
            }
            
            // Validation du formulaire
            const form = document.getElementById('mission-form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const selectedEmployees = document.querySelectorAll('.employee-checkbox:checked');
                    if (selectedEmployees.length === 0) {
                        e.preventDefault();
                        showErrorAlert('Veuillez sélectionner au moins un employé pour cette mission.');
                        return false;
                    }
                });
            }
            
            // Initialisation du compteur
            updateSelectedCount();
        });
        
        // Fonction pour ouvrir le modal de finalisation
        function openFinalizeModal(missionId, missionTitle) {
            document.getElementById('finalizeMissionName').textContent = missionTitle;
            document.getElementById('finalizeForm').action = `/missions/${missionId}/update-status`;
            document.getElementById('finalizeModal').classList.remove('hidden');
        }

        // Fonction pour ouvrir le modal de suppression de mission
        function openDeleteMissionModal(missionId, missionTitle) {
            document.getElementById('deleteMissionName').textContent = missionTitle;
            document.getElementById('deleteMissionForm').action = `/missions/${missionId}`;
            document.getElementById('deleteMissionModal').classList.remove('hidden');
        }

        // Fonction pour fermer les modals
        function closeFinalizeModal() {
            document.getElementById('finalizeModal').classList.add('hidden');
        }

        function closeDeleteMissionModal() {
            document.getElementById('deleteMissionModal').classList.add('hidden');
        }
    </script>

    <!-- Modal de finalisation de mission -->
    <div id="finalizeModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 dark:bg-green-900">
                    <svg class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mt-4">Finaliser la mission</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Êtes-vous sûr de vouloir finaliser la mission <span id="finalizeMissionName" class="font-medium"></span> ? 
                        Les employés assignés seront libérés.
                    </p>
                </div>
                <div class="items-center px-4 py-3">
                    <form id="finalizeForm" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="terminee">
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white text-base font-medium rounded-md w-24 mr-2 shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-300">
                            Finaliser
                        </button>
                    </form>
                    <button onclick="closeFinalizeModal()" class="px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md w-24 shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de suppression de mission -->
    <div id="deleteMissionModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 dark:bg-red-900">
                    <svg class="h-6 w-6 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mt-4">Confirmer la suppression</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Êtes-vous sûr de vouloir supprimer la mission <span id="deleteMissionName" class="font-medium"></span> ? 
                        Cette action libérera tous les employés assignés et ne peut pas être annulée.
                    </p>
                </div>
                <div class="items-center px-4 py-3">
                    <form id="deleteMissionForm" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md w-24 mr-2 shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300">
                            Supprimer
                        </button>
                    </form>
                    <button onclick="closeDeleteMissionModal()" class="px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md w-24 shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fermer les modals en cliquant à l'extérieur
        document.getElementById('finalizeModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeFinalizeModal();
            }
        });

        document.getElementById('deleteMissionModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteMissionModal();
            }
        });
    </script>
    @endpush
</x-app-layout>