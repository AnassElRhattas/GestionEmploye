@if(!request()->ajax())
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Liste des employés') }}
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
                    <!-- En-tête avec recherche, filtre et bouton d'ajout -->
                    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                        <!-- Barre de recherche améliorée -->
                        <div class="relative w-full md:w-1/3">
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </div>
                                <input type="text" id="search" placeholder="Rechercher un employé..." class="w-full pl-10 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 transition duration-200">
                            </div>
                        </div>
                        
                        <!-- Filtre par disponibilité -->
                        <div class="relative w-full md:w-1/3">
                            <select id="filter-disponible" class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 transition duration-200">
                                <option value="">Tous</option>
                                <option value="true">Disponibles</option>
                                <option value="false">Non disponibles</option>
                            </select>
                        </div>
                        
                        <!-- Boutons d'action -->
                        <div class="flex space-x-2">
                            <a href="{{ route('employees.create') }}" class="flex items-center justify-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 transition duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Ajouter un employé
                            </a>
                        </div>
                    </div>
@endif

                    <div id="employees-table">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            @if($employees->isEmpty())
                                <div class="p-8 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">Aucun employé</h3>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Commencez par ajouter un nouvel employé.</p>
                                    <div class="mt-6">
                                        <a href="{{ route('employees.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                            </svg>
                                            Ajouter un employé
                                        </a>
                                    </div>
                                </div>
                            @else
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">#</th>
                                            <th scope="col" class="px-6 py-3">Nom</th>
                                            <th scope="col" class="px-6 py-3">Prénom</th>
                                            <th scope="col" class="px-6 py-3">Âge</th>
                                            <th scope="col" class="px-6 py-3">Zone rurale</th>
                                            <th scope="col" class="px-6 py-3">Expérience</th>
                                            <th scope="col" class="px-6 py-3">Disponibilité</th>
                                            <th scope="col" class="px-6 py-3 text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($employees as $index => $employee)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="px-6 py-4">{{ $index + 1 }}</td>
                                            <td class="px-6 py-4">{{ $employee->nom }}</td>
                                            <td class="px-6 py-4">{{ $employee->prenom }}</td>
                                            <td class="px-6 py-4">{{ $employee->age }} ans</td>
                                            <td class="px-6 py-4">{{ $employee->zone_rurale }}</td>
                                            <td class="px-6 py-4">{{ $employee->experience_annees }} ans</td>
                                            
                                            <!-- Disponibilité avec badge -->
                                            <td class="px-6 py-4">
                                                <button onclick="toggleAvailability({{ $employee->id }}, this)"
                                                    class="px-2 py-1 text-xs font-semibold rounded-full {{ $employee->disponible ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ $employee->disponible ? 'Disponible' : 'Non disponible' }}
                                                </button>
                                            </td>
                                            
                                            <!-- Actions -->
                                            <td class="px-6 py-4">
                                                <div class="flex items-center justify-center space-x-3">
                                                    <!-- Bouton View avec icône -->
                                                    <a href="{{ route('employees.show', $employee) }}"
                                                        class="p-1.5 bg-green-100 text-green-600 rounded-lg hover:bg-green-200 transition-colors duration-200" 
                                                        title="Voir les détails">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                    </a>
                                                    
                                                    <!-- Bouton Edit avec icône -->
                                                    <a href="{{ route('employees.edit', $employee) }}"
                                                        class="p-1.5 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition-colors duration-200" 
                                                        title="Modifier">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </a>
                                                    
                                                    <!-- Menu déroulant pour plus d'actions -->
                                                    <div class="relative" x-data="{ open: false }">
                                                        <button @click="open = !open" class="p-1.5 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition-colors duration-200" title="Plus d'actions">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                                            </svg>
                                                        </button>
                                                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg z-10 border border-gray-200 dark:border-gray-700">
                                                            <!-- Bouton de suppression -->
                                                            <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="w-full">
                                                                @csrf @method('DELETE')
                                                                <button type="submit" onclick="event.preventDefault(); confirmSupprimerEmploye(this.parentNode.parentNode)" class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                                    <div class="flex items-center">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                        </svg>
                                                                        Supprimer
                                                                    </div>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                
                                <!-- Pagination -->
                                <div class="px-6 py-4">
                                    {{ $employees->links('vendor.pagination.tailwind') }}
                                </div>
                            @endif
                        </div>
                    </div>
            
            @if(!request()->ajax())
        </div>
    </div>

    <script>
        const searchInput   = document.getElementById('search');
        const filterSelect  = document.getElementById('filter-disponible');
        let searchTimer;

        function fetchEmployees() {
            const params = new URLSearchParams({
                search: searchInput.value,
                disponible: filterSelect.value
            });
            fetch(`{{ route('employees.index') }}?${params}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.text())
            .then(html => document.getElementById('employees-table').innerHTML = html);
        }

        searchInput.addEventListener('input', () => {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(fetchEmployees, 300);
        });

        filterSelect.addEventListener('change', fetchEmployees);

        function toggleAvailability(id, btn) {
            fetch(`/employees/${id}/toggle-availability`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    btn.textContent = data.disponible ? 'Disponible' : 'Non disponible';
                    btn.classList.toggle('bg-green-100', data.disponible);
                    btn.classList.toggle('text-green-800', data.disponible);
                    btn.classList.toggle('bg-red-100', !data.disponible);
                    btn.classList.toggle('text-red-800', !data.disponible);
                    if (filterSelect.value) fetchEmployees();
                }
            })
            .catch(() => showErrorAlert('Erreur lors du changement de disponibilité'));
        }
    </script>
</x-app-layout>
@endif