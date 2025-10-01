<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    @if($employees->isEmpty())
        <div class="p-8 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">Aucun employé</h3>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Aucun résultat pour votre recherche/filtre.</p>
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
                    <th scope="col" class="px-6 py-3">Évaluation</th>
                    <th scope="col" class="px-6 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($employees as $index => $employee)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">{{ $employees->firstItem() + $index }}</td>
                    <td class="px-6 py-4">{{ $employee->nom }}</td>
                    <td class="px-6 py-4">{{ $employee->prenom }}</td>
                    <td class="px-6 py-4">{{ $employee->age }} ans</td>
                    <td class="px-6 py-4">{{ $employee->zone_rurale }}</td>
                    <td class="px-6 py-4">{{ $employee->experience_annees }} ans</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $employee->disponible ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $employee->disponible ? 'Disponible' : 'Non disponible' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        @php $stars = $employee->evaluation_stars ?? 0; @endphp
                        <div class="flex items-center">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="h-4 w-4 {{ $i <= $stars ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.802 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.802-2.034a1 1 0 00-1.175 0l-2.802 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81H7.03a1 1 0 00.95-.69l1.07-3.292z"/></svg>
                            @endfor
                            <span class="ml-2 text-xs text-gray-500">{{ $stars }}/5</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center space-x-3">
                            <a href="{{ route('employees.show', $employee) }}" class="p-1.5 bg-green-100 text-green-600 rounded-lg hover:bg-green-200" title="Voir"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg></a>
                            <a href="{{ route('employees.edit', $employee) }}" class="p-1.5 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200" title="Modifier"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg></a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="px-6 py-4">
            {{ $employees->links('vendor.pagination.tailwind') }}
        </div>
    @endif
</div>

