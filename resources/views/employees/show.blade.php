<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Détails de l\'employé') }}
            </h2>
            <span class="px-3 py-1 {{ $employee->disponible ? 'bg-blue-600 dark:bg-blue-500' : 'bg-red-600 dark:bg-red-500' }} text-white rounded-full text-sm font-medium shadow-sm">
                {{ $employee->disponible ? 'Disponible' : 'Non disponible' }}
            </span>
        </div>
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
                        <a href="{{ route('employees.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 dark:focus:ring-offset-gray-800 transition-all duration-150 ease-in-out">
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl leading-6 font-bold text-gray-900 dark:text-white">{{ $employee->prenom }} {{ $employee->nom }}</h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                {{ $employee->experience_annees }} ans d'expérience • 
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $employee->zone_rurale }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
                    <!-- Informations personnelles -->
                    <div class="bg-white dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600 shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300">
                        <div class="px-4 py-3 bg-gray-50 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-600">
                            <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200">Informations personnelles</h3>
                        </div>
                        <div class="p-4 space-y-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Nom complet</p>
                                    <p class="text-base font-medium text-gray-900 dark:text-gray-100">{{ $employee->prenom }} {{ $employee->nom }}</p>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div class="w-10 h-10 flex items-center justify-center rounded-full bg-yellow-100 dark:bg-yellow-900 text-yellow-600 dark:text-yellow-300 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.802 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.802-2.034a1 1 0 00-1.175 0l-2.802 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81H7.03a1 1 0 00.95-.69l1.07-3.292z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Évaluation</p>
                                    <div class="flex items-center">
                                        @php $stars = $employee->evaluation_stars ?? 0; @endphp
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg class="h-5 w-5 {{ $i <= $stars ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.802 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.802-2.034a1 1 0 00-1.175 0l-2.802 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81H7.03a1 1 0 00.95-.69l1.07-3.292z"/></svg>
                                        @endfor
                                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ $stars }}/5</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="w-10 h-10 flex items-center justify-center rounded-full bg-yellow-100 dark:bg-yellow-900 text-yellow-600 dark:text-yellow-300 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M6 3a1 1 0 011-1h.01a1 1 0 010 2H7a1 1 0 01-1-1zm2 3a1 1 0 00-2 0v1a2 2 0 00-2 2v1a2 2 0 00-2 2v.683a3.7 3.7 0 011.055.485 1.704 1.704 0 001.89 0 3.704 3.704 0 014.11 0 1.704 1.704 0 001.89 0 3.704 3.704 0 014.11 0 1.704 1.704 0 001.89 0A3.7 3.7 0 0118 12.683V12a2 2 0 00-2-2V9a2 2 0 00-2-2V6a1 1 0 10-2 0v1h-1V6a1 1 0 10-2 0v1H8V6zm10 8.868a3.704 3.704 0 01-4.055-.036 1.704 1.704 0 00-1.89 0 3.704 3.704 0 01-4.11 0 1.704 1.704 0 00-1.89 0A3.704 3.704 0 012 14.868V17a1 1 0 001 1h14a1 1 0 001-1v-2.132zM9 3a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1zm3 0a1 1 0 011-1h.01a1 1 0 110 2H13a1 1 0 01-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Âge</p>
                                    <p class="text-base font-medium text-gray-900 dark:text-gray-100">{{ $employee->age }} ans</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="w-10 h-10 flex items-center justify-center rounded-full bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-300 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Zone rurale</p>
                                    <p class="text-base font-medium text-gray-900 dark:text-gray-100">{{ $employee->zone_rurale }}</p>
                                </div>
                            </div>
                            
                            @if($employee->telephone)
                            <div class="flex items-center">
                                <div class="w-10 h-10 flex items-center justify-center rounded-full bg-purple-100 dark:bg-purple-900 text-purple-600 dark:text-purple-300 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Téléphone</p>
                                    <p class="text-base font-medium text-gray-900 dark:text-gray-100">{{ $employee->telephone }}</p>
                                </div>
                            </div>
                            @endif
                            
                            @if($employee->identifiant)
                            <div class="flex items-center">
                                <div class="w-10 h-10 flex items-center justify-center rounded-full bg-indigo-100 dark:bg-indigo-900 text-indigo-600 dark:text-indigo-300 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Identifiant</p>
                                    <p class="text-base font-medium text-gray-900 dark:text-gray-100">{{ $employee->identifiant }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Informations professionnelles -->
                    <div class="bg-white dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600 shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300">
                        <div class="px-4 py-3 bg-gray-50 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-600">
                            <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200">Informations professionnelles</h3>
                        </div>
                        <div class="p-4 space-y-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
                                        <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Expérience</p>
                                    <p class="text-base font-medium text-gray-900 dark:text-gray-100">{{ $employee->experience_annees }} ans</p>
                                </div>
                            </div>
                            
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Disponibilité</p>
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium {{ $employee->disponible ? 'bg-blue-600 dark:bg-blue-500 text-white' : 'bg-red-600 dark:bg-red-500 text-white' }} shadow-sm">
                                    @if($employee->disponible)
                                        <svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Disponible
                                    @else
                                        <svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Non disponible
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Expérience par culture -->
                <div class="px-6 pb-6">
                    <div class="bg-white dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600 shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300">
                        <div class="px-4 py-3 bg-gray-50 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-600">
                            <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200">Expérience par culture</h3>
                        </div>
                        <div class="p-4">
                            <div class="flex flex-wrap gap-3">
                                @php
                                    $cultures = is_string($employee->experience_cultures) ? json_decode($employee->experience_cultures) : $employee->experience_cultures;
                                @endphp
                                @foreach($cultures as $culture)
                                    <span class="px-4 py-2 bg-blue-600 dark:bg-blue-500 text-white rounded-full text-sm font-medium shadow-sm flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        {{ ucfirst($culture) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Spécialités -->
                <div class="px-6 pb-6">
                    <div class="bg-white dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600 shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300">
                        <div class="px-4 py-3 bg-gray-50 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-600">
                            <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200">Spécialités</h3>
                        </div>
                        <div class="p-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                @php
                                    $specialites = is_string($employee->specialites) ? json_decode($employee->specialites) : $employee->specialites;
                                @endphp
                                @foreach($specialites as $specialite)
                                    <div class="flex items-center p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-100 dark:border-blue-800 hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-colors duration-150">
                                        <svg class="h-5 w-5 text-blue-600 dark:text-blue-400 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-gray-800 dark:text-gray-200 font-medium">{{ $specialite }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Remarque d'évaluation -->
                @if($employee->evaluation_remark)
                <div class="px-6 pb-6">
                    <div class="bg-white dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600 shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300">
                        <div class="px-4 py-3 bg-gray-50 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-600">
                            <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200">Remarque d'évaluation</h3>
                        </div>
                        <div class="p-4">
                            <p class="text-gray-800 dark:text-gray-200">{{ $employee->evaluation_remark }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Actions -->
                <div class="px-6 pb-6">
                    <div class="bg-white dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600 shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300">
                        <div class="px-4 py-3 bg-gray-50 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-600">
                            <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200">Actions</h3>
                        </div>
                        <div class="p-4 flex flex-wrap gap-3">
                            <a href="{{ route('employees.edit', $employee) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 dark:bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 dark:hover:bg-blue-600 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 dark:focus:ring-blue-800 active:bg-blue-800 dark:active:bg-blue-700 disabled:opacity-25 transition">
                                <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Modifier
                            </a>
                            <a href="{{ route('employees.pdf', $employee) }}" class="inline-flex items-center px-4 py-2 bg-green-600 dark:bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 dark:hover:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 dark:focus:ring-green-800 active:bg-green-800 dark:active:bg-green-700 disabled:opacity-25 transition">
                                <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Télécharger PDF
                            </a>
                            <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 dark:bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 dark:hover:bg-red-600 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 dark:focus:ring-red-800 active:bg-red-800 dark:active:bg-red-700 disabled:opacity-25 transition" onclick="event.preventDefault(); confirmSupprimerEmploye(this.parentNode)">
                                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>