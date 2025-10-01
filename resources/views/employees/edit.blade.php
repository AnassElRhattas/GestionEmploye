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
                                            
                                            <!-- Téléphone -->
                                            <div>
                                                <x-input-label for="telephone" :value="__('Téléphone')" class="text-gray-700 dark:text-gray-300 font-medium" />
                                                <div class="relative mt-1">
                                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                        </svg>
                                                    </div>
                                                    <x-text-input id="telephone" class="block mt-1 w-full pl-10 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition-all duration-200" type="tel" name="telephone" :value="old('telephone', $employee->telephone)" />
                                                </div>
                                                <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
                                            </div>
                                            
                                            <!-- Identifiant -->
                                            <div>
                                                <x-input-label for="identifiant" :value="__('Identifiant')" class="text-gray-700 dark:text-gray-300 font-medium" />
                                                <div class="relative mt-1">
                                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                                        </svg>
                                                    </div>
                                                    <x-text-input id="identifiant" class="block mt-1 w-full pl-10 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition-all duration-200" type="text" name="identifiant" :value="old('identifiant', $employee->identifiant)" />
                                                </div>
                                                <x-input-error :messages="$errors->get('identifiant')" class="mt-2" />
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

                                            <!-- Évaluation -->
                                            <div class="mt-4">
                                                <h4 class="text-gray-700 dark:text-gray-300 font-medium mb-2">Évaluation</h4>
                                                <div class="flex items-center gap-2 mb-3">
                                                    <input type="hidden" id="evaluation_stars" name="evaluation_stars" value="{{ old('evaluation_stars', $employee->evaluation_stars ?? 0) }}">
                                                    <div id="star-container" class="flex">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <button type="button" data-star="{{ $i }}" class="star-btn {{ (old('evaluation_stars', $employee->evaluation_stars ?? 0) >= $i) ? 'text-yellow-400' : 'text-gray-300' }}">
                                                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.802 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.802-2.034a1 1 0 00-1.175 0l-2.802 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81H7.03a1 1 0 00.95-.69l1.07-3.292z"/></svg>
                                                            </button>
                                                        @endfor
                                                    </div>
                                                    <span id="star-label" class="text-sm text-gray-600 dark:text-gray-400">{{ old('evaluation_stars', $employee->evaluation_stars ?? 0) }}/5</span>
                                                </div>
                                                <div>
                                                    <x-input-label for="evaluation_remark" :value="__('Remarque')" />
                                                    <textarea id="evaluation_remark" name="evaluation_remark" rows="3" class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 transition duration-200" placeholder="Écrivez une remarque...">{{ old('evaluation_remark', $employee->evaluation_remark) }}</textarea>
                                                    <x-input-error :messages="$errors->get('evaluation_remark')" class="mt-2" />
                                                </div>
                                            </div>
                                            
                                            <!-- Expérience par culture -->
                                            <div class="mt-4">
                                                <x-input-label :value="__('Expérience par culture')" class="text-gray-700 dark:text-gray-300 font-medium mb-2" />
                                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
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
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hiddenInput = document.getElementById('evaluation_stars');
            const label = document.getElementById('star-label');
            const buttons = document.querySelectorAll('#star-container .star-btn');

            function renderStars(value) {
                buttons.forEach((btn) => {
                    const star = parseInt(btn.getAttribute('data-star'));
                    if (star <= value) {
                        btn.classList.add('text-yellow-400');
                        btn.classList.remove('text-gray-300');
                    } else {
                        btn.classList.add('text-gray-300');
                        btn.classList.remove('text-yellow-400');
                    }
                });
                if (label) label.textContent = `${value}/5`;
            }

            buttons.forEach((btn) => {
                btn.addEventListener('click', () => {
                    const value = parseInt(btn.getAttribute('data-star'));
                    hiddenInput.value = value;
                    renderStars(value);
                });
            });

            renderStars(parseInt(hiddenInput.value || '0'));
        });
    </script>
    @endpush
</x-app-layout>