<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Suivi de mission') }}: {{ $mission->title }}
            </h2>
            <div class="flex space-x-3">
                <a href="{{ route('missions.pdf', $mission) }}" target="_blank" 
                   class="inline-flex items-center px-3 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"></path>
                    </svg>
                    {{ __('PDF') }}
                </a>
                <a href="{{ route('missions.index') }}"
                   class="inline-flex items-center px-3 py-2 bg-gray-200 rounded-md text-gray-700 text-xs font-semibold uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Retour
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statut et progression -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="mr-4">
                                <span class="inline-flex items-center justify-center h-12 w-12 rounded-full {{ $mission->status === 'en_cours' ? 'bg-green-100' : 'bg-blue-100' }}">
                                    @if($mission->status === 'en_cours')
                                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @else
                                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    @endif
                                </span>
                            </div>
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">Statut: 
                                    <span class="font-semibold {{ $mission->status === 'en_cours' ? 'text-green-600' : 'text-blue-600' }}">
                                        {{ $mission->status === 'en_cours' ? 'En cours' : 'Terminée' }}
                                    </span>
                                </h3>
                                <p class="text-sm text-gray-500">
                                    @if($mission->status === 'en_cours')
                                        Mission active avec {{ $mission->employees->count() }} employé(s) assigné(s)
                                    @else
                                        Mission complétée
                                    @endif
                                </p>
                            </div>
                        </div>
                        
                        @if ($mission->status === 'en_cours')
                            <form method="POST" action="{{ route('missions.update-status', $mission) }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="terminee">
                                <x-danger-button
                                    onclick="return confirm('Êtes-vous sûr de vouloir finaliser cette mission ?')">
                                    {{ __('Finaliser la mission') }}
                                </x-danger-button>
                            </form>
                        @endif
                    </div>
                    
                    <!-- Barre de progression -->
                    @if($mission->start_date && $mission->end_date && $mission->status === 'en_cours')
                        @php
                            $startDate = $mission->start_date;
                            $endDate = $mission->end_date;
                            $today = now();
                            $totalDays = $startDate->diffInDays($endDate);
                            $daysElapsed = $startDate->diffInDays($today);
                            $progress = $totalDays > 0 ? min(100, round(($daysElapsed / $totalDays) * 100)) : 0;
                        @endphp
                        <div class="mt-6">
                            <div class="flex justify-between text-xs text-gray-600 mb-1">
                                <span>Progression</span>
                                <span>{{ $progress }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $progress }}%"></div>
                            </div>
                            <div class="flex justify-between text-xs text-gray-500 mt-1">
                                <span>{{ $startDate->format('d/m/Y') }}</span>
                                <span>{{ $endDate->format('d/m/Y') }}</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Détails de la mission -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Détails de la mission
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="mb-3">
                                        <span class="text-sm font-medium text-gray-500">Nature:</span>
                                        <p class="mt-1 font-medium">{{ $mission->title }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <span class="text-sm font-medium text-gray-500">Entreprise:</span>
                                        <p class="mt-1">{{ $mission->company }}</p>
                                    </div>
                                </div>
                                
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="mb-3">
                                        <span class="text-sm font-medium text-gray-500">Durée:</span>
                                        <p class="mt-1">
                                            @if ($mission->duration_days)
                                                <span class="font-medium">{{ $mission->duration_days }} jours</span>
                                            @elseif($mission->start_date && $mission->end_date)
                                                Du <span class="font-medium">{{ $mission->start_date->format('d/m/Y') }}</span> au <span class="font-medium">{{ $mission->end_date->format('d/m/Y') }}</span>
                                            @else
                                                Non spécifiée
                                            @endif
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <span class="text-sm font-medium text-gray-500">Date de création:</span>
                                        <p class="mt-1">{{ $mission->created_at->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            @if ($mission->notes)
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <span class="text-sm font-medium text-gray-500">Description et objectifs:</span>
                                    <p class="mt-2 text-gray-700 whitespace-pre-line">{{ $mission->notes }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Chronologie -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Chronologie
                            </h3>
                            
                            <div class="relative pl-8 pb-1">
                                <div class="absolute top-0 left-0 h-full w-0.5 bg-gray-200"></div>
                                
                                <div class="relative mb-6">
                                    <div class="absolute -left-8 mt-1.5 w-4 h-4 rounded-full bg-green-500 border-4 border-white"></div>
                                    <div class="bg-green-50 p-3 rounded-lg">
                                        <h4 class="font-medium text-green-800">Création de la mission</h4>
                                        <p class="text-sm text-gray-600">{{ $mission->created_at->format('d/m/Y à H:i') }}</p>
                                    </div>
                                </div>
                                
                                @if($mission->start_date)
                                <div class="relative mb-6">
                                    <div class="absolute -left-8 mt-1.5 w-4 h-4 rounded-full bg-blue-500 border-4 border-white"></div>
                                    <div class="bg-blue-50 p-3 rounded-lg">
                                        <h4 class="font-medium text-blue-800">Début de la mission</h4>
                                        <p class="text-sm text-gray-600">{{ $mission->start_date->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                                @endif
                                
                                @if($mission->status === 'terminee')
                                <div class="relative mb-6">
                                    <div class="absolute -left-8 mt-1.5 w-4 h-4 rounded-full bg-indigo-500 border-4 border-white"></div>
                                    <div class="bg-indigo-50 p-3 rounded-lg">
                                        <h4 class="font-medium text-indigo-800">Mission terminée</h4>
                                        <p class="text-sm text-gray-600">{{ $mission->updated_at->format('d/m/Y à H:i') }}</p>
                                    </div>
                                </div>
                                @elseif($mission->end_date)
                                <div class="relative mb-6">
                                    <div class="absolute -left-8 mt-1.5 w-4 h-4 rounded-full {{ $mission->end_date->isPast() ? 'bg-red-500' : 'bg-gray-300' }} border-4 border-white"></div>
                                    <div class="{{ $mission->end_date->isPast() ? 'bg-red-50' : 'bg-gray-50' }} p-3 rounded-lg">
                                        <h4 class="font-medium {{ $mission->end_date->isPast() ? 'text-red-800' : 'text-gray-800' }}">
                                            {{ $mission->end_date->isPast() ? 'Date de fin dépassée' : 'Date de fin prévue' }}
                                        </h4>
                                        <p class="text-sm text-gray-600">{{ $mission->end_date->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Employés assignés -->
                <div class="lg:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                Équipe assignée <span class="text-sm text-gray-500 ml-2">({{ $mission->employees->count() }})</span>
                            </h3>
                            
                            @if ($mission->employees->isEmpty())
                                <div class="bg-yellow-50 p-4 rounded-lg text-center">
                                    <svg class="h-12 w-12 text-yellow-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                    <p class="text-yellow-700">Aucun employé assigné à cette mission.</p>
                                </div>
                            @else
                                <div class="space-y-4">
                                    @foreach ($mission->employees as $employee)
                                        <div class="bg-gray-50 p-4 rounded-lg border-l-4 {{ $mission->status === 'en_cours' ? 'border-yellow-400' : 'border-green-400' }}">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <h4 class="font-medium text-gray-900 flex items-center">
                                                        <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                        </svg>
                                                        {{ $employee->nom }} {{ $employee->prenom }}
                                                    </h4>
                                                    
                                                    @if ($employee->experience_annees)
                                                        <p class="text-sm text-gray-500 mt-1 flex items-center">
                                                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                            </svg>
                                                            <span>{{ $employee->experience_annees }} ans d'expérience</span>
                                                        </p>
                                                    @endif
                                                    
                                                    @php
                                                        $specs = is_array($employee->specialites)
                                                            ? $employee->specialites
                                                            : json_decode($employee->specialites, true);
                                                    @endphp

                                                    @if (!empty($specs))
                                                        <div class="mt-2">
                                                            <p class="text-xs text-gray-500 mb-1">Spécialités:</p>
                                                            <div class="flex flex-wrap gap-1">
                                                                @foreach ($specs as $spec)
                                                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                                                        {{ $spec }}
                                                                    </span>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $mission->status === 'en_cours' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                                    {{ $mission->status === 'en_cours' ? 'Assigné' : 'Libéré' }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
