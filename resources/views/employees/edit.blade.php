<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Modifier un employé') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg rounded-lg border border-gray-100">
                <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-indigo-600 to-blue-600">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-white p-2 rounded-full mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl leading-6 font-bold text-white">Modifier l'employé</h3>
                            <p class="mt-1 max-w-2xl text-sm text-white text-opacity-90">Modifiez les informations de l'employé dans le formulaire ci-dessous</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('employees.update', $employee) }}" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Informations personnelles -->
                            <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                                <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                                    <h3 class="text-lg font-medium text-gray-800">Informations personnelles</h3>
                                </div>
                                <div class="p-4 space-y-4">
                                    <!-- Nom -->
                                    <div>
                                        <x-input-label for="nom" :value="__('Nom')" class="text-gray-700 font-medium" />
                                        <x-text-input id="nom" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-all duration-200" type="text" name="nom" :value="old('nom', $employee->nom)" required autofocus />
                                        <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                                    </div>
                                    
                                    <!-- Prénom -->
                                    <div>
                                        <x-input-label for="prenom" :value="__('Prénom')" class="text-gray-700 font-medium" />
                                        <x-text-input id="prenom" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-all duration-200" type="text" name="prenom" :value="old('prenom', $employee->prenom)" required />
                                        <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
                                    </div>
                                    
                                    <!-- Âge -->
                                    <div>
                                        <x-input-label for="age" :value="__('Âge')" class="text-gray-700 font-medium" />
                                        <x-text-input id="age" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-all duration-200" type="number" name="age" :value="old('age', $employee->age)" required min="18" max="100" />
                                        <x-input-error :messages="$errors->get('age')" class="mt-2" />
                                    </div>
                                    
                                    <!-- Zone rurale -->
                                    <div>
                                        <x-input-label for="zone_rurale" :value="__('Zone rurale')" class="text-gray-700 font-medium" />
                                        <x-text-input id="zone_rurale" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-all duration-200" type="text" name="zone_rurale" :value="old('zone_rurale', $employee->zone_rurale)" required />
                                        <x-input-error :messages="$errors->get('zone_rurale')" class="mt-2" />
                                    </div>
                                </div>
                            </div>

                            <!-- Informations professionnelles -->
                            <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                                <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                                    <h3 class="text-lg font-medium text-gray-800">Informations professionnelles</h3>
                                </div>
                                <div class="p-4 space-y-4">
                                    <!-- Expérience (années) -->
                                    <div>
                                        <x-input-label for="experience_annees" :value="__('Expérience (années)')" class="text-gray-700 font-medium" />
                                        <x-text-input id="experience_annees" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-all duration-200" type="number" name="experience_annees" :value="old('experience_annees', $employee->experience_annees)" required min="0" />
                                        <x-input-error :messages="$errors->get('experience_annees')" class="mt-2" />
                                    </div>
                                    
                                    <!-- Disponibilité -->
                                    <div class="mt-4">
                                        <h4 class="text-gray-700 font-medium mb-2">Disponibilité</h4>
                                        <div class="flex items-center p-2 rounded-lg border border-gray-200 hover:bg-indigo-500 transition-colors duration-150">
                                            <input 
                                                type="checkbox" 
                                                id="disponible" 
                                                name="disponible" 
                                                value="1"
                                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                                {{ $employee->disponible ? 'checked' : '' }}
                                            >
                                            <label for="disponible" class="ml-2 text-sm text-gray-700 font-medium">Disponible</label>
                                        </div>
                                        <x-input-error :messages="$errors->get('disponible')" class="mt-2" />
                                    </div>
                                    
                                    <!-- Expérience par culture -->
                                    <div class="mt-4">
                                        <x-input-label :value="__('Expérience par culture')" class="text-gray-700 font-medium mb-2" />
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                            @php
                                                $cultures = ['maraîchage', 'arboriculture', 'ornementale', 'élevage'];
                                            @endphp
                                            
                                            @foreach($cultures as $culture)
                                                <div class="flex items-center p-2 rounded-lg border border-gray-200 hover:bg-indigo-50 transition-colors duration-150">
                                                    <input 
                                                        type="checkbox" 
                                                        id="culture_{{ $culture }}" 
                                                        name="experience_cultures[]" 
                                                        value="{{ $culture }}"
                                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                                        {{ in_array($culture, is_array($employee->experience_cultures) ? $employee->experience_cultures : json_decode($employee->experience_cultures ?? '[]', true)) ? 'checked' : '' }}
                                                    >
                                                    <label for="culture_{{ $culture }}" class="ml-2 text-sm text-gray-700 font-medium">{{ ucfirst($culture) }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <x-input-error :messages="$errors->get('experience_cultures')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Spécialités -->
                        <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                            <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                                <h3 class="text-lg font-medium text-gray-800">Spécialités</h3>
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
                                        <div class="flex items-center p-2 rounded-lg border border-gray-200 hover:bg-indigo-50 transition-colors duration-150">
                                            <input 
                                                type="checkbox" 
                                                id="specialite_{{ $index + 1 }}" 
                                                name="specialites[]" 
                                                value="{{ $specialite }}"
                                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                                {{ in_array($specialite, is_array($employee->specialites) ? $employee->specialites : json_decode($employee->specialites ?? '[]', true)) ? 'checked' : '' }}
                                            >
                                            <label for="specialite_{{ $index + 1 }}" class="ml-2 text-sm text-gray-700 font-medium">{{ $specialite }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <x-input-error :messages="$errors->get('specialites')" class="mt-2" />
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-end mt-6 gap-4">
                            <a href="{{ route('employees.index') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-gray-500 to-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:from-gray-600 hover:to-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-25 transition-all duration-150 ease-in-out">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                                </svg>
                                {{ __('Annuler') }}
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:from-indigo-600 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition-all duration-150 ease-in-out">
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
</x-app-layout>