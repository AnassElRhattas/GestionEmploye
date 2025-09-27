<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Ajouter un employé') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg rounded-lg border border-gray-100">
                <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-green-600 to-green-700">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-white p-2 rounded-full mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl leading-6 font-bold text-white">Nouvel employé</h3>
                            <p class="mt-1 max-w-2xl text-sm text-white text-opacity-90">Remplissez le formulaire ci-dessous pour ajouter un nouvel employé</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('employees.store') }}" class="space-y-6">
                        @csrf
                        
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
                                        <x-text-input id="nom" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-all duration-200" type="text" name="nom" :value="old('nom')" required autofocus />
                                        <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                                    </div>
                                    
                                    <!-- Prénom -->
                                    <div>
                                        <x-input-label for="prenom" :value="__('Prénom')" class="text-gray-700 font-medium" />
                                        <x-text-input id="prenom" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-all duration-200" type="text" name="prenom" :value="old('prenom')" required />
                                        <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
                                    </div>
                                    
                                    <!-- Âge -->
                                    <div>
                                        <x-input-label for="age" :value="__('Âge')" class="text-gray-700 font-medium" />
                                        <x-text-input id="age" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-all duration-200" type="number" name="age" :value="old('age')" required min="18" max="100" />
                                        <x-input-error :messages="$errors->get('age')" class="mt-2" />
                                    </div>
                                    
                                    <!-- Zone rurale -->
                                    <div>
                                        <x-input-label for="zone_rurale" :value="__('Zone rurale')" class="text-gray-700 font-medium" />
                                        <x-text-input id="zone_rurale" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-all duration-200" type="text" name="zone_rurale" :value="old('zone_rurale')" required />
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
                                        <x-text-input id="experience_annees" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-all duration-200" type="number" name="experience_annees" :value="old('experience_annees')" required min="0" />
                                        <x-input-error :messages="$errors->get('experience_annees')" class="mt-2" />
                                    </div>
                                    
                                    <!-- Expérience par culture -->
                                    <div>
                                        <x-input-label :value="__('Expérience par culture')" class="text-gray-700 font-medium mb-2" />
                                        <div class="mt-2 grid grid-cols-1 sm:grid-cols-2 gap-3">
                                            @foreach($cultures as $culture)
                                                <div class="flex items-center p-2 rounded-lg border border-gray-200 hover:bg-green-50 transition-colors duration-150">
                                                    <input type="checkbox" id="culture_{{ $culture }}" name="experience_cultures[]" value="{{ $culture }}" class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500" {{ in_array($culture, old('experience_cultures', [])) ? 'checked' : '' }}>
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
                                    @foreach($specialites as $index => $specialite)
                                        <div class="flex items-center p-2 rounded-lg border border-gray-200 hover:bg-green-50 transition-colors duration-150">
                                            <input type="checkbox" id="specialite_{{ $index + 1 }}" name="specialites[]" value="{{ $specialite }}" class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500" {{ in_array($specialite, old('specialites', [])) ? 'checked' : '' }}>
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
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:from-green-600 hover:to-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-25 transition-all duration-150 ease-in-out">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                {{ __('Enregistrer') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>