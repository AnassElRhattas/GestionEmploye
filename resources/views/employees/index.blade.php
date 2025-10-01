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
                        @include('employees._table', ['employees' => $employees])
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
            .then(html => {
                const container = document.getElementById('employees-table');
                container.innerHTML = html;
                // Ensure any JS behaviors re-bind if needed
            });
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

    <!-- Modal de suppression -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 dark:bg-red-900">
                    <svg class="h-6 w-6 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mt-4">Confirmer la suppression</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Êtes-vous sûr de vouloir supprimer l'employé <span id="employeeName" class="font-medium"></span> ? 
                        Cette action est irréversible.
                    </p>
                </div>
                <div class="items-center px-4 py-3">
                    <form id="deleteForm" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md w-24 mr-2 shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300">
                            Supprimer
                        </button>
                    </form>
                    <button onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md w-24 shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openDeleteModal(employeeId, employeeName) {
            document.getElementById('employeeName').textContent = employeeName;
            document.getElementById('deleteForm').action = `/employees/${employeeId}`;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // Fermer le modal en cliquant à l'extérieur
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });
    </script>
</x-app-layout>
@endif