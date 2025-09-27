<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Modifier un employé') }}
        </h2>
    </x-slot>
    
    <!-- Alpine.js pour les menus déroulants -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Messages de notification -->
            @if(session('success'))
                <div id="notification" class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 flex justify-between items-center">
                    <div>
                        <p class="font-bold">Succès!</p>
                        <p>{{ session('success') }}</p>
                    </div>
                    <button onclick="document.getElementById('notification').remove()" class="text-green-700 hover:text-green-900">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endif
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Bouton de retour -->
                    <div class="mb-6">
                        <a href="{{ route('employees.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-150 ease-in-out">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>
                            {{ __('Retour à la liste') }}
                        </a>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-lg rounded-lg border border-gray-200 dark:border-gray-600">
                        <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-blue-100 dark:bg-blue-900 p-2 rounded-full mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600 dark:text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl leading-6 font-bold text-gray-900 dark:text-white">Modifier l'employé</h3>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">Modifiez les informations de l'employé dans le formulaire ci-dessous</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <form method="POST" action="{{ route('employees.update', $employee) }}" class="space-y-6">
                                @csrf
                                @method('PUT')
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Informations personnelles -->
                                    <div class="bg-white dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600 shadow-sm overflow-hidden">
                                        <div class="px-4 py-3 bg-gray-50 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-600">
                                            <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200">Informations personnelles</h3>
                                        </div>
                                        <div class="p-4 space-y-4">
                                            <!-- Nom -->
                                            <div>
                                                <x-input-label for="nom" :value="__('Nom')" class="text-gray-700 dark:text-gray-300 font-medium" />
                                                <div class="relative mt-1">
                                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                        </svg>
                                                    </div>
                                                    <x-text-input id="nom" class="block mt-1 w-full pl-10 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition-all duration-200" type="text" name="nom" :value="old('nom', $employee->nom)" required autofocus />
                                                </div>
                                                <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                                            </div>
                                            
                                            <!-- Prénom -->
                                            <div>
                                                <x-input-label for="prenom" :value="__('Prénom')" class="text-gray-700 dark:text-gray-300 font-medium" />
                                                <div class="relative mt-1">
                                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                        </svg>
                                                    </div>
                                                    <x-text-input id="prenom" class="block mt-1 w-full pl-10 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition-all duration-200" type="text" name="prenom" :value="old('prenom', $employee->prenom)" required />
                                                </div>
                                                <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
                                            </div>
                                            
                                            <!-- Âge -->
                                            <div>
                                                <x-input-label for="age" :value="__('Âge')" class="text-gray-700 dark:text-gray-300 font-medium" />
                                                <div class="relative mt-1">
                                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                    </div>
                                                    <x-text-input id="age" class="block mt-1 w-full pl-10 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition-all duration-200" type="number" name="age" :value="old('age', $employee->age)" required min="18" max="100" />
                                                </div>
                                                <x-input-error :messages="$errors->get('age')" class="mt-2" />
                                            </div>
                                            
                                            <!-- Zone rurale -->
                                            <div>
                                                <x-input-label for="zone_rurale" :value="__('Zone rurale')" class="text-gray-700 dark:text-gray-300 font-medium" />
                                                <div class="relative mt-1">
                                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        </svg>
                                                    </div>
                                                    <x-text-input id="zone_rurale" class="block mt-1 w-full pl-10 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition-all duration-200" type="text" name="zone_rurale" :value="old('zone_rurale', $employee->zone_rurale)" required />
                                                </div>
                                                <x-input-error :messages="$errors->get('zone_rurale')" class="mt-2" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Informations professionnelles -->
                                    <div class="bg-white dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600 shadow-sm overflow-hidden">
                                        <div class="px-4 py-3 bg-gray-50 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-600">
                                            <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200">Informations professionnelles</h3>
                                        </div>
                                        <div class="p-4 space-y-4">
                                            <!-- Expérience (années) -->
                                            <div>
                                                <x-input-label for="experience_annees" :value="__('Expérience (années)')" class="text-gray-700 dark:text-gray-300 font-medium" />
                                                <div class="relative mt-1">
                                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                        </svg>
                                                    </div>
                                                    <x-text-input id="experience_annees" class="block mt-1 w-full pl-10 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition-all duration-200" type="number" name="experience_annees" :value="old('experience_annees', $employee->experience_annees)" required min="0" />
                                                </div>
                                                <x-input-error :messages="$errors->get('experience_annees')" class="mt-2" />
                                            </div>
                                            
                                            <!-- Disponibilité -->
                                            <div class="mt-4">
                                                <h4 class="text-gray-700 dark:text-gray-300 font-medium mb-2">Disponibilité</h4>
                                                <div class="flex items-center p-2 rounded-lg border border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-150">
                                                    <input 
                                                        type="checkbox" 
                                                        id="disponible" 
                                                        name="disponible" 
                                                        value="1"
                                                        class="rounded border-gray-300 dark:border-gray-600 text-blue-600 shadow-sm focus:ring-blue-500"
                                                        {{ $employee->disponible ? 'checked' : '' }}
                                                    >
                                                    <label for="disponible" class="ml-2 text-sm text-gray-700 dark:text-gray-300 font-medium">Disponible</label>
                                                </div>
                                                <x-input-error :messages="$errors->get('disponible')" class="mt-2" />
                                            </div>
                                            
                                            <!-- Expérience par culture -->
                                            <div class="mt-4">
                                                <x-input-label :value="__('Expérience par culture')" class="text-gray-700 dark:text-gray-300 font-medium mb-2" />
                                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                                    @php
                                                        $cultures = ['maraîchage', 'arboriculture', 'ornementale', 'élevage'];
                                                    @endphp
                                                    
                                                    @foreach($cultures as $culture)
                                                        <div class="flex items-center p-2 rounded-lg border border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-150">
                                                            <input 
                                                                type="checkbox" 
                                                                id="culture_{{ $culture }}" 
                                                                name="experience_cultures[]" 
                                                                value="{{ $culture }}"
                                                                class="rounded border-gray-300 dark:border-gray-600 text-blue-600 shadow-sm focus:ring-blue-500"
                                                                {{ in_array($culture, is_array($employee->experience_cultures) ? $employee->experience_cultures : json_decode($employee->experience_cultures ?? '[]', true)) ? 'checked' : '' }}
                                                            >
                                                            <label for="culture_{{ $culture }}" class="ml-2 text-sm text-gray-700 dark:text-gray-300 font-medium">{{ ucfirst($culture) }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <x-input-error :messages="$errors->get('experience_cultures')" class="mt-2" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Spécialités -->
                                <div class="bg-white dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600 shadow-sm overflow-hidden">
                                    <div class="px-4 py-3 bg-gray-50 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-600">
                                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200">Spécialités</h3>
                                    </div>
                                    <div class="p-4">
                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                            @php
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
                                            @endphp
                                            
                                            @foreach($specialites as $index => $specialite)
                                                <div class="flex items-center p-2 rounded-lg border border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-150">
                                                    <input 
                                                        type="checkbox" 
                                                        id="specialite_{{ $index + 1 }}" 
                                                        name="specialites[]" 
                                                        value="{{ $specialite }}"
                                                        class="rounded border-gray-300 dark:border-gray-600 text-blue-600 shadow-sm focus:ring-blue-500"
                                                        {{ in_array($specialite, is_array($employee->specialites) ? $employee->specialites : json_decode($employee->specialites ?? '[]', true)) ? 'checked' : '' }}
                                                    >
                                                    <label for="specialite_{{ $index + 1 }}" class="ml-2 text-sm text-gray-700 dark:text-gray-300 font-medium">{{ $specialite }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <x-input-error :messages="$errors->get('specialites')" class="mt-2" />
                                    </div>
                                </div>
                                
                                <div class="flex items-center justify-end mt-6 gap-4">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-25 transition-all duration-150 ease-in-out">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        {{ __('Mettre à jour') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>