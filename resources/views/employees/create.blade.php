<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600 dark:text-blue-300 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Ajouter un employé') }}
                </h2>
            </div>
            <a href="{{ route('employees.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 active:bg-gray-400 dark:active:bg-gray-600 focus:outline-none focus:border-gray-900 dark:focus:border-gray-500 focus:ring ring-gray-300 dark:ring-gray-700 disabled:opacity-25 transition ease-in-out duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                {{ __('Retour à la liste') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div id="success-alert" class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded flex justify-between items-center animate-fade-in-down">
                            <div>
                                <p class="font-bold">Succès!</p>
                                <p>{{ session('success') }}</p>
                            </div>
                            <button onclick="document.getElementById('success-alert').remove()" class="text-green-700 hover:text-green-900">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    @endif

                    <div class="mb-6 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-100 dark:border-blue-800">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-600 dark:text-blue-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-blue-800 dark:text-blue-200">Informations importantes</h3>
                                <div class="mt-1 text-sm text-blue-700 dark:text-blue-300">
                                    <p>Remplissez tous les champs obligatoires (*) pour créer un nouvel employé.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('employees.store') }}" class="space-y-6" id="employee-form" novalidate>
                        @csrf
                        
                        <!-- Message d'information -->
                        <div class="mb-6 p-4 bg-blue-50 dark:bg-blue-900/30 border-l-4 border-blue-500 dark:border-blue-400 text-blue-700 dark:text-blue-300 rounded">
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <p class="font-medium">Information</p>
                                    <p class="text-sm">Les champs marqués d'un <span class="text-red-500">*</span> sont obligatoires.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Section Informations Personnelles -->
                            <div class="space-y-6 bg-white dark:bg-gray-700 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600">
                                <div class="flex items-center border-b border-gray-200 dark:border-gray-600 pb-3 mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 dark:text-blue-300 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Informations personnelles') }}</h3>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Nom -->
                                    <div>
                                        <x-input-label for="nom" :value="__('Nom *')" />
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </div>
                                            <x-text-input id="nom" name="nom" type="text" class="mt-1 block w-full pl-10" :value="old('nom')" required autofocus placeholder="Nom de l'employé" />
                                        </div>
                                        <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                                    </div>
                                    
                                    <!-- Prénom -->
                                    <div>
                                        <x-input-label for="prenom" :value="__('Prénom *')" />
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </div>
                                            <x-text-input id="prenom" name="prenom" type="text" class="mt-1 block w-full pl-10" :value="old('prenom')" required placeholder="Prénom de l'employé" />
                                        </div>
                                        <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Âge -->
                                    <div>
                                        <x-input-label for="age" :value="__('Âge *')" />
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <x-text-input id="age" name="age" type="number" class="mt-1 block w-full pl-10" :value="old('age')" required placeholder="Âge de l'employé" min="18" max="100" />
                                        </div>
                                        <x-input-error :messages="$errors->get('age')" class="mt-2" />
                                    </div>
                                    
                                    <!-- Zone rurale -->
                                    <div>
                                        <x-input-label for="zone_rurale" :value="__('Zone rurale *')" />
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                            </div>
                                            <x-text-input id="zone_rurale" name="zone_rurale" type="text" class="mt-1 block w-full pl-10" :value="old('zone_rurale')" required placeholder="Zone rurale" />
                                        </div>
                                        <x-input-error :messages="$errors->get('zone_rurale')" class="mt-2" />
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Téléphone -->
                                    <div>
                                        <x-input-label for="telephone" :value="__('Téléphone')" />
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                </svg>
                                            </div>
                                            <x-text-input id="telephone" name="telephone" type="tel" class="mt-1 block w-full pl-10" :value="old('telephone')" placeholder="Numéro de téléphone" />
                                        </div>
                                        <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
                                    </div>
                                    
                                    <!-- Identifiant -->
                                    <div>
                                        <x-input-label for="identifiant" :value="__('Identifiant')" />
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                                </svg>
                                            </div>
                                            <x-text-input id="identifiant" name="identifiant" type="text" class="mt-1 block w-full pl-10" :value="old('identifiant')" placeholder="Identifiant unique" />
                                        </div>
                                        <x-input-error :messages="$errors->get('identifiant')" class="mt-2" />
                                    </div>
                                </div>
                            </div>

                            <!-- Section Informations Professionnelles -->
                            <div class="space-y-6 bg-white dark:bg-gray-700 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600">
                                <div class="flex items-center border-b border-gray-200 dark:border-gray-600 pb-3 mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 dark:text-blue-300 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Informations professionnelles') }}</h3>
                                </div>
                                
                                <!-- Expérience (années) -->
                                <div>
                                    <x-input-label for="experience_annees" :value="__('Expérience (années) *')" />
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <x-text-input id="experience_annees" name="experience_annees" type="number" class="mt-1 block w-full pl-10" :value="old('experience_annees')" required placeholder="Expérience en années" min="0" />
                                    </div>
                                    <x-input-error :messages="$errors->get('experience_annees')" class="mt-2" />
                                </div>
                                
                                <!-- Expérience par culture -->
                                <div>
                                    <x-input-label :value="__('Expérience par culture *')" class="mb-2" />
                                    <div class="relative mb-2">
                                        <input type="text" id="culture-search" placeholder="Rechercher une culture..." class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 transition duration-200">
                                    </div>
                                    <div class="mt-2 grid grid-cols-1 sm:grid-cols-2 gap-3 bg-white dark:bg-gray-700 p-3 rounded-md shadow-sm border border-gray-200 dark:border-gray-600 max-h-48 overflow-y-auto">
                                        @foreach($cultures as $culture)
                                            <div class="culture-item flex items-center p-2 rounded-lg border border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-150">
                                                <input type="checkbox" id="culture_{{ $culture }}" name="experience_cultures[]" value="{{ $culture }}" class="rounded border-gray-300 dark:border-gray-600 text-blue-600 shadow-sm focus:ring-blue-500" {{ in_array($culture, old('experience_cultures', [])) ? 'checked' : '' }}>
                                                <label for="culture_{{ $culture }}" class="ml-2 text-sm text-gray-700 dark:text-gray-300 font-medium">{{ ucfirst($culture) }}</label>
                                            </div>
                                        @endforeach
                                        <!-- Autre culture -->
                                        <div class="culture-item flex items-center p-2 rounded-lg border border-dashed border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-150">
                                            <input type="checkbox" id="culture_autre_cb" class="rounded border-gray-300 dark:border-gray-600 text-blue-600 shadow-sm focus:ring-blue-500">
                                            <label for="culture_autre_cb" class="ml-2 text-sm text-gray-700 dark:text-gray-300 font-medium">Autre</label>
                                        </div>
                                        <div id="culture_autre_input_wrap" class="col-span-1 sm:col-span-2 hidden">
                                            <div class="mt-2 flex items-center gap-2">
                                                <x-input-label for="other_culture" :value="__('Nouvelle culture')" />
                                                <input type="text" id="other_culture" name="other_culture" value="{{ old('other_culture') }}" placeholder="Saisir une culture personnalisée" class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 transition duration-200">
                                                <button type="button" id="add_other_culture" class="inline-flex items-center px-3 py-2 bg-blue-600 dark:bg-blue-500 text-white rounded hover:bg-blue-700 dark:hover:bg-blue-600">Ajouter</button>
                                            </div>
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->get('experience_cultures')" class="mt-2" />
                                </div>
                                
                                <!-- Spécialités -->
                                <div>
                                    <x-input-label :value="__('Spécialités *')" class="mb-2" />
                                    <div class="relative mb-2">
                                        <input type="text" id="specialite-search" placeholder="Rechercher une spécialité..." class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 transition duration-200">
                                    </div>
                                    <div class="mt-2 grid grid-cols-1 sm:grid-cols-2 gap-3 bg-white dark:bg-gray-700 p-3 rounded-md shadow-sm border border-gray-200 dark:border-gray-600 max-h-48 overflow-y-auto">
                                        @foreach($specialites as $specialite)
                                            <div class="specialite-item flex items-center p-2 rounded-lg border border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-150">
                                                <input type="checkbox" id="specialite_{{ $specialite }}" name="specialites[]" value="{{ $specialite }}" class="rounded border-gray-300 dark:border-gray-600 text-blue-600 shadow-sm focus:ring-blue-500" {{ in_array($specialite, old('specialites', [])) ? 'checked' : '' }}>
                                                <label for="specialite_{{ $specialite }}" class="ml-2 text-sm text-gray-700 dark:text-gray-300 font-medium">{{ ucfirst($specialite) }}</label>
                                            </div>
                                        @endforeach
                                        <!-- Autre spécialité -->
                                        <div class="specialite-item flex items-center p-2 rounded-lg border border-dashed border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-150">
                                            <input type="checkbox" id="specialite_autre_cb" class="rounded border-gray-300 dark:border-gray-600 text-blue-600 shadow-sm focus:ring-blue-500">
                                            <label for="specialite_autre_cb" class="ml-2 text-sm text-gray-700 dark:text-gray-300 font-medium">Autre</label>
                                        </div>
                                        <div id="specialite_autre_input_wrap" class="col-span-1 sm:col-span-2 hidden">
                                            <div class="mt-2 flex items-center gap-2">
                                                <x-input-label for="other_specialite" :value="__('Nouvelle spécialité')" />
                                                <input type="text" id="other_specialite" name="other_specialite" value="{{ old('other_specialite') }}" placeholder="Saisir une spécialité personnalisée" class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 transition duration-200">
                                                <button type="button" id="add_other_specialite" class="inline-flex items-center px-3 py-2 bg-blue-600 dark:bg-blue-500 text-white rounded hover:bg-blue-700 dark:hover:bg-blue-600">Ajouter</button>
                                            </div>
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->get('specialites')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        
                        <!-- Résumé des sélections -->
                        <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 mt-6">
                            <div class="flex items-center border-b border-gray-200 dark:border-gray-600 pb-3 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 dark:text-blue-300 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Résumé') }}</h3>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <h4 class="font-medium text-gray-700 dark:text-gray-300 mb-2">Cultures sélectionnées:</h4>
                                    <div id="selected-cultures" class="text-sm text-gray-600 dark:text-gray-400 min-h-[40px] p-2 bg-gray-50 dark:bg-gray-800 rounded">
                                        <span class="italic">Aucune culture sélectionnée</span>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-700 dark:text-gray-300 mb-2">Spécialités sélectionnées:</h4>
                                    <div id="selected-specialites" class="text-sm text-gray-600 dark:text-gray-400 min-h-[40px] p-2 bg-gray-50 dark:bg-gray-800 rounded">
                                        <span class="italic">Aucune spécialité sélectionnée</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="flex justify-end space-x-3 mt-8">
                            <a href="{{ route('employees.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 active:bg-gray-400 dark:active:bg-gray-600 focus:outline-none focus:border-gray-900 dark:focus:border-gray-500 focus:ring ring-gray-300 dark:ring-gray-700 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Annuler') }}
                            </a>
                            <button type="submit" id="submit-btn" class="inline-flex items-center px-4 py-2 bg-blue-600 dark:bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 dark:hover:bg-blue-600 active:bg-blue-800 dark:active:bg-blue-700 focus:outline-none focus:border-blue-900 dark:focus:border-blue-800 focus:ring ring-blue-300 dark:ring-blue-200 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Enregistrer') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Éléments du formulaire
            const form = document.getElementById('employee-form');
            const submitBtn = document.getElementById('submit-btn');
            const cultureSearch = document.getElementById('culture-search');
            const specialiteSearch = document.getElementById('specialite-search');
            const cultureItems = document.querySelectorAll('.culture-item');
            const specialiteItems = document.querySelectorAll('.specialite-item');
            const selectedCulturesDiv = document.getElementById('selected-cultures');
            const selectedSpecialitesDiv = document.getElementById('selected-specialites');
            const otherCultureCheckbox = document.getElementById('culture_autre_cb');
            const otherCultureWrap = document.getElementById('culture_autre_input_wrap');
            const otherCultureInput = document.getElementById('other_culture');
            const otherSpecialiteCheckbox = document.getElementById('specialite_autre_cb');
            const otherSpecialiteWrap = document.getElementById('specialite_autre_input_wrap');
            const otherSpecialiteInput = document.getElementById('other_specialite');
            const addOtherCultureBtn = document.getElementById('add_other_culture');
            const addOtherSpecialiteBtn = document.getElementById('add_other_specialite');
            
            // Fonction pour mettre à jour l'affichage des sélections
            function updateSelections() {
                // Cultures
                const selectedCultures = Array.from(document.querySelectorAll('input[name="experience_cultures[]"]:checked'))
                    .map(checkbox => checkbox.nextElementSibling.textContent.trim());
                
                if (selectedCultures.length > 0) {
                    selectedCulturesDiv.innerHTML = selectedCultures.map(culture => 
                        `<span class="inline-block bg-blue-100 dark:bg-blue-800 text-blue-800 dark:text-blue-200 px-2 py-1 rounded mr-2 mb-2">${culture}</span>`
                    ).join('');
                } else {
                    selectedCulturesDiv.innerHTML = '<span class="italic">Aucune culture sélectionnée</span>';
                }
                
                // Spécialités
                const selectedSpecialites = Array.from(document.querySelectorAll('input[name="specialites[]"]:checked'))
                    .map(checkbox => checkbox.nextElementSibling.textContent.trim());
                
                if (selectedSpecialites.length > 0) {
                    selectedSpecialitesDiv.innerHTML = selectedSpecialites.map(specialite => 
                        `<span class="inline-block bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-200 px-2 py-1 rounded mr-2 mb-2">${specialite}</span>`
                    ).join('');
                } else {
                    selectedSpecialitesDiv.innerHTML = '<span class="italic">Aucune spécialité sélectionnée</span>';
                }
            }
            
            // Filtrer les cultures
            cultureSearch.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                cultureItems.forEach(item => {
                    const text = item.textContent.toLowerCase();
                    item.style.display = text.includes(searchTerm) ? 'flex' : 'none';
                });
            });
            
            // Filtrer les spécialités
            specialiteSearch.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                specialiteItems.forEach(item => {
                    const text = item.textContent.toLowerCase();
                    item.style.display = text.includes(searchTerm) ? 'flex' : 'none';
                });
            });

            // Gérer l'affichage des champs "Autre"
            function toggleOtherField(checkbox, wrap, input) {
                if (!checkbox) return;
                const update = () => {
                    if (checkbox.checked) {
                        wrap.classList.remove('hidden');
                        input.focus();
                    } else {
                        wrap.classList.add('hidden');
                        input.value = '';
                    }
                };
                checkbox.addEventListener('change', update);
                update();
            }

            toggleOtherField(otherCultureCheckbox, otherCultureWrap, otherCultureInput);
            toggleOtherField(otherSpecialiteCheckbox, otherSpecialiteWrap, otherSpecialiteInput);

            async function postCustomChoice(type, value) {
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const resp = await fetch("{{ route('custom-choices.store') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ type, value })
                });
                if (!resp.ok) {
                    throw new Error('Erreur lors de l\'ajout');
                }
                return await resp.json();
            }

            function createChoiceElement(kind, value) {
                const wrapper = document.createElement('div');
                wrapper.className = `${kind}-item flex items-center p-2 rounded-lg border border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-150`;
                const input = document.createElement('input');
                input.type = 'checkbox';
                input.id = `${kind}_` + value;
                input.name = kind === 'culture' ? 'experience_cultures[]' : 'specialites[]';
                input.value = value;
                input.className = 'rounded border-gray-300 dark:border-gray-600 text-blue-600 shadow-sm focus:ring-blue-500';
                input.checked = true;
                const label = document.createElement('label');
                label.htmlFor = input.id;
                label.className = 'ml-2 text-sm text-gray-700 dark:text-gray-300 font-medium';
                label.textContent = value.charAt(0).toUpperCase() + value.slice(1);
                wrapper.appendChild(input);
                wrapper.appendChild(label);
                return wrapper;
            }

            function insertAfter(newNode, referenceNode) {
                referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
            }

            if (addOtherCultureBtn) {
                addOtherCultureBtn.addEventListener('click', async () => {
                    const val = (otherCultureInput.value || '').trim();
                    if (!val) return;
                    addOtherCultureBtn.disabled = true;
                    try {
                        await postCustomChoice('culture', val);
                        const choiceEl = createChoiceElement('culture', val);
                        // Insérer juste après la ligne "Autre"
                        const otherItem = document.getElementById('culture_autre_cb').closest('.culture-item');
                        insertAfter(choiceEl, otherItem);
                        // Réinitialiser champ
                        otherCultureInput.value = '';
                        updateSelections();
                    } catch (e) {
                        alert('Impossible d\'ajouter la culture.');
                    } finally {
                        addOtherCultureBtn.disabled = false;
                    }
                });
            }

            if (addOtherSpecialiteBtn) {
                addOtherSpecialiteBtn.addEventListener('click', async () => {
                    const val = (otherSpecialiteInput.value || '').trim();
                    if (!val) return;
                    addOtherSpecialiteBtn.disabled = true;
                    try {
                        await postCustomChoice('specialite', val);
                        const choiceEl = createChoiceElement('specialite', val);
                        const otherItem = document.getElementById('specialite_autre_cb').closest('.specialite-item');
                        insertAfter(choiceEl, otherItem);
                        otherSpecialiteInput.value = '';
                        updateSelections();
                    } catch (e) {
                        alert('Impossible d\'ajouter la spécialité.');
                    } finally {
                        addOtherSpecialiteBtn.disabled = false;
                    }
                });
            }
            
            // Mettre à jour les sélections quand une case est cochée/décochée
            document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                checkbox.addEventListener('change', updateSelections);
            });
            
            // Validation du formulaire
            form.addEventListener('submit', function(e) {
                let isValid = true;
                let firstInvalidField = null;
                
                // Valider les champs requis
                const requiredFields = form.querySelectorAll('input[required]');
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.classList.add('border-red-500');
                        if (!firstInvalidField) firstInvalidField = field;
                    } else {
                        field.classList.remove('border-red-500');
                    }
                });
                
                // Valider qu'au moins une culture est sélectionnée
                const selectedCultures = form.querySelectorAll('input[name="experience_cultures[]"]:checked');
                const hasOtherCulture = otherCultureCheckbox && otherCultureCheckbox.checked && otherCultureInput.value.trim() !== '';
                if (selectedCultures.length === 0 && !hasOtherCulture) {
                    isValid = false;
                    document.querySelector('.culture-item').parentElement.classList.add('border-red-500');
                    if (!firstInvalidField) firstInvalidField = cultureSearch;
                } else {
                    document.querySelector('.culture-item').parentElement.classList.remove('border-red-500');
                }
                
                // Valider qu'au moins une spécialité est sélectionnée
                const selectedSpecialites = form.querySelectorAll('input[name="specialites[]"]:checked');
                const hasOtherSpecialite = otherSpecialiteCheckbox && otherSpecialiteCheckbox.checked && otherSpecialiteInput.value.trim() !== '';
                if (selectedSpecialites.length === 0 && !hasOtherSpecialite) {
                    isValid = false;
                    document.querySelector('.specialite-item').parentElement.classList.add('border-red-500');
                    if (!firstInvalidField) firstInvalidField = specialiteSearch;
                } else {
                    document.querySelector('.specialite-item').parentElement.classList.remove('border-red-500');
                }
                
                if (!isValid) {
                    e.preventDefault();
                    if (firstInvalidField) firstInvalidField.focus();
                    
                    // Afficher un message d'erreur
                    const errorAlert = document.createElement('div');
                    errorAlert.className = 'mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded animate-fade-in-down';
                    errorAlert.innerHTML = `
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-bold">Erreur!</p>
                                <p>Veuillez remplir tous les champs obligatoires.</p>
                            </div>
                            <button onclick="this.parentElement.parentElement.remove()" class="text-red-700 hover:text-red-900">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    `;
                    
                    // Insérer le message d'erreur au début du formulaire
                    form.insertBefore(errorAlert, form.firstChild);
                    
                    // Faire défiler jusqu'au message d'erreur
                    errorAlert.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
            
            // Initialiser l'affichage des sélections
            updateSelections();
        });
    </script>
    @endpush
</x-app-layout>