<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des employés') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg rounded-lg border border-gray-200">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4 bg-gradient-to-r from-gray-50 to-gray-100 p-5 rounded-lg border border-gray-200 shadow-md">
                        <div class="flex flex-col md:flex-row items-center space-y-3 md:space-y-0 md:space-x-5 w-full md:w-auto">
                            <div class="w-full md:w-auto">
                                <label for="search" class="block text-sm font-semibold text-gray-700 mb-2">Rechercher un employé</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" id="search" placeholder="Rechercher par nom ou prénom..." class="pl-10 w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-all duration-200 py-2.5">
                                </div>
                            </div>
                            <div class="w-full md:w-auto">
                                <label for="filter-disponible" class="block text-sm font-semibold text-gray-700 mb-2">Filtrer par disponibilité</label>
                                <select id="filter-disponible" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-all duration-200 py-2.5 pl-3 pr-10">
                                    <option value="">Tous les employés</option>
                                    <option value="true">Disponibles uniquement</option>
                                    <option value="false">Non disponibles uniquement</option>
                                </select>
                            </div>
                        </div>
                        <div class="w-full md:w-auto mt-4 md:mt-0">
                            <a href="{{ route('employees.create') }}" class="w-full md:w-auto inline-flex items-center justify-center px-5 py-3 bg-gradient-to-r from-green-500 to-green-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wider hover:from-green-600 hover:to-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-200 shadow-lg transform hover:scale-105">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                {{ __('Ajouter un employé') }}
                            </a>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-md mb-4 flex items-center" role="alert">
                            <svg class="h-6 w-6 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div id="employees-table" class="bg-white rounded-lg shadow-inner border border-gray-100">
                        @include('employees.table')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Recherche en temps réel
        const searchInput = document.getElementById('search');
        const filterDisponible = document.getElementById('filter-disponible');
        let searchTimer;

        function performSearch() {
            const searchValue = searchInput.value;
            const disponibleValue = filterDisponible.value;
            
            fetch(`{{ route('employees.index') }}?search=${searchValue}&disponible=${disponibleValue}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                document.getElementById('employees-table').innerHTML = html;
            });
        }

        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(performSearch, 300);
        });

        filterDisponible.addEventListener('change', performSearch);

        // Fonction pour basculer la disponibilité
        function toggleAvailability(employeeId, button) {
            fetch(`{{ url('/employees') }}/${employeeId}/toggle-availability`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    if (data.disponible) {
                        button.textContent = 'Disponible';
                        button.classList.remove('bg-red-600', 'hover:bg-red-700');
                        button.classList.add('bg-green-600', 'hover:bg-green-700');
                    } else {
                        button.textContent = 'Non disponible';
                        button.classList.remove('bg-green-600', 'hover:bg-green-700');
                        button.classList.add('bg-red-600', 'hover:bg-red-700');
                    }
                    // Rafraîchir la liste si un filtre est actif
                    if (filterDisponible.value) {
                        performSearch();
                    }
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Une erreur est survenue lors du changement de disponibilité');
            });
        }
    </script>
</x-app-layout>