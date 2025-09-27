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
                                <label for="employees" class="block text-sm font-medium text-gray-700">Employés disponibles</label>
                                <select name="employees[]" id="employees" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" multiple>
                                    @foreach($availableEmployees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->nom }} {{ $employee->prenom }} ({{ $employee->poste }})</option>
                                    @endforeach
                                </select>
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
            // Initialisation de Select2 pour la sélection multiple d'employés
            $('#employees').select2({
                placeholder: 'Sélectionnez les employés',
                allowClear: true
            });
            
            // Gestion de l'affichage du tableau des missions
            const missionTable = document.getElementById('mission-table');
            const noMissionsMessage = document.getElementById('no-missions');
            
            if (missionTable.getElementsByTagName('tbody')[0].getElementsByTagName('tr').length === 0) {
                missionTable.classList.add('hidden');
                noMissionsMessage.classList.remove('hidden');
            } else {
                missionTable.classList.remove('hidden');
                noMissionsMessage.classList.add('hidden');
            }
        });
    </script>
    @endpush
</x-app-layout>