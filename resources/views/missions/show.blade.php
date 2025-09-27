<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Suivi de mission') }}: {{ $mission->title }}
            </h2>
            <a href="{{ route('missions.index') }}"
                class="px-4 py-2 bg-gray-200 rounded-md text-gray-700 text-sm hover:bg-gray-300">
                Retour aux missions
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Détails de la mission -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Détails de la mission</h3>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="mb-3">
                                    <span class="text-sm font-medium text-gray-500">Nature:</span>
                                    <p class="mt-1">{{ $mission->title }}</p>
                                </div>
                                <div class="mb-3">
                                    <span class="text-sm font-medium text-gray-500">Entreprise:</span>
                                    <p class="mt-1">{{ $mission->company }}</p>
                                </div>
                                <div class="mb-3">
                                    <span class="text-sm font-medium text-gray-500">Durée:</span>
                                    <p class="mt-1">
                                        @if ($mission->duration_days)
                                            {{ $mission->duration_days }} jours
                                        @elseif($mission->start_date && $mission->end_date)
                                            {{ $mission->start_date->format('d/m/Y') }} -
                                            {{ $mission->end_date->format('d/m/Y') }}
                                        @else
                                            Non spécifiée
                                        @endif
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <span class="text-sm font-medium text-gray-500">Statut:</span>
                                    <p class="mt-1">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $mission->status === 'en_cours' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $mission->status === 'en_cours' ? 'En cours' : 'Terminée' }}
                                        </span>
                                    </p>
                                </div>
                                @if ($mission->notes)
                                    <div class="mb-3">
                                        <span class="text-sm font-medium text-gray-500">Notes:</span>
                                        <p class="mt-1">{{ $mission->notes }}</p>
                                    </div>
                                @endif
                            </div>

                            @if ($mission->status === 'en_cours')
                                <div class="mt-6">
                                    <form method="POST" action="{{ route('missions.update-status', $mission) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="terminee">
                                        <x-danger-button
                                            onclick="return confirm('Êtes-vous sûr de vouloir finaliser cette mission ?')">
                                            {{ __('Finaliser la mission') }}
                                        </x-danger-button>
                                    </form>
                                </div>
                            @endif
                        </div>

                        <!-- Employés assignés -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Employés assignés</h3>
                            @if ($mission->employees->isEmpty())
                                <p class="text-gray-500">Aucun employé assigné à cette mission.</p>
                            @else
                                <div class="space-y-3">
                                    @foreach ($mission->employees as $employee)
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <h4 class="font-medium text-gray-900">{{ $employee->nom }}
                                                        {{ $employee->prenom }}</h4>
                                                    <p class="text-sm text-gray-500 mt-1">
                                                        @php
                                                            $specs = is_array($employee->specialites)
                                                                ? $employee->specialites
                                                                : json_decode($employee->specialites, true);
                                                        @endphp

                                                        @if (!empty($specs))
                                                            <span>Spécialités :</span>
                                                            <ul>
                                                                @foreach ($specs as $spec)
                                                                    <li>{{ $spec }}</li>
                                                                @endforeach
                                                            </ul>
                                                        @endif


                                                        @if ($employee->experience_annees)
                                                            <span>Expérience: {{ $employee->experience_annees }}
                                                                ans</span>
                                                        @endif
                                                    </p>
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
