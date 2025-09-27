<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Ajouter un employé') }}
            </h2>
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
                        <div id="success-alert" class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded flex justify-between items-center">
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

                    <form method="POST" action="{{ route('employees.store') }}" class="space-y-6">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Section Informations Personnelles -->
                            <div class="space-y-6">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Informations personnelles') }}</h3>
                                
                                <!-- Nom -->
                                <div>
                                    <x-input-label for="nom" :value="__('Nom')" />
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
                                    <x-input-label for="prenom" :value="__('Prénom')" />
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
                                
                                <!-- Âge -->
                                <div>
                                    <x-input-label for="age" :value="__('Âge')" />
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
                                    <x-input-label for="zone_rurale" :value="__('Zone rurale')" />
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

                            <!-- Section Informations Professionnelles -->
                            <div class="space-y-6">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Informations professionnelles') }}</h3>
                                
                                <!-- Expérience (années) -->
                                <div>
                                    <x-input-label for="experience_annees" :value="__('Expérience (années)')" />
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
                                    <x-input-label :value="__('Expérience par culture')" class="mb-2" />
                                    <div class="mt-2 grid grid-cols-1 sm:grid-cols-2 gap-3 bg-white dark:bg-gray-700 p-3 rounded-md shadow-sm border border-gray-200 dark:border-gray-600">
                                        @foreach($cultures as $culture)
                                            <div class="flex items-center p-2 rounded-lg border border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-150">
                                                <input type="checkbox" id="culture_{{ $culture }}" name="experience_cultures[]" value="{{ $culture }}" class="rounded border-gray-300 dark:border-gray-600 text-blue-600 shadow-sm focus:ring-blue-500" {{ in_array($culture, old('experience_cultures', [])) ? 'checked' : '' }}>
                                                <label for="culture_{{ $culture }}" class="ml-2 text-sm text-gray-700 dark:text-gray-300 font-medium">{{ ucfirst($culture) }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <x-input-error :messages="$errors->get('experience_cultures')" class="mt-2" />
                                </div>
                                
                                <!-- Spécialités -->
                                <div>
                                    <x-input-label :value="__('Spécialités')" class="mb-2" />
                                    <div class="mt-2 grid grid-cols-1 sm:grid-cols-2 gap-3 bg-white dark:bg-gray-700 p-3 rounded-md shadow-sm border border-gray-200 dark:border-gray-600">
                                        @foreach($specialites as $specialite)
                                            <div class="flex items-center p-2 rounded-lg border border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-150">
                                                <input type="checkbox" id="specialite_{{ $specialite }}" name="specialites[]" value="{{ $specialite }}" class="rounded border-gray-300 dark:border-gray-600 text-blue-600 shadow-sm focus:ring-blue-500" {{ in_array($specialite, old('specialites', [])) ? 'checked' : '' }}>
                                                <label for="specialite_{{ $specialite }}" class="ml-2 text-sm text-gray-700 dark:text-gray-300 font-medium">{{ ucfirst($specialite) }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <x-input-error :messages="$errors->get('specialites')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        
                        <!-- Boutons d'action -->
                        <div class="flex justify-end space-x-3 mt-8">
                            <a href="{{ route('employees.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 active:bg-gray-400 dark:active:bg-gray-600 focus:outline-none focus:border-gray-900 dark:focus:border-gray-500 focus:ring ring-gray-300 dark:ring-gray-700 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Annuler') }}
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 dark:bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 dark:hover:bg-blue-600 active:bg-blue-800 dark:active:bg-blue-700 focus:outline-none focus:border-blue-900 dark:focus:border-blue-800 focus:ring ring-blue-300 dark:ring-blue-200 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Enregistrer') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>