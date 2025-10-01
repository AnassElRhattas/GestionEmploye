<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion WhatsApp') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-6">
                    @if(!$isServiceAvailable || !$isWhatsAppConnected)
                        <div class="p-4 rounded border border-yellow-300 bg-yellow-50 text-yellow-800 dark:border-yellow-600 dark:bg-yellow-900/20 dark:text-yellow-200">
                            <div class="font-semibold mb-1">Attention</div>
                            <div>
                                @if(!$isServiceAvailable)
                                    Le service WhatsApp n'est pas disponible. Démarrez le service Node et rechargez la page.
                                @elseif(!$isWhatsAppConnected)
                                    WhatsApp n'est pas connecté. Scannez le QR ci-dessous pour lier l'appareil.
                                @endif
                            </div>
                        </div>
                    @endif
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="p-4 border border-gray-200 dark:border-gray-700 rounded bg-white dark:bg-gray-800">
                            <h3 class="font-semibold mb-3">Statut du service</h3>
                            <p class="mb-1"><span class="font-medium">Service disponible:</span> <span class="{{ $isServiceAvailable ? 'text-green-600' : 'text-red-600' }}">{{ $isServiceAvailable ? 'Oui' : 'Non' }}</span></p>
                            <p><span class="font-medium">WhatsApp connecté:</span> <span class="{{ $isWhatsAppConnected ? 'text-green-600' : 'text-red-600' }}">{{ $isWhatsAppConnected ? 'Oui' : 'Non' }}</span></p>
                        </div>

                        <div class="p-4 border border-gray-200 dark:border-gray-700 rounded bg-white dark:bg-gray-800 md:col-span-2">
                            <h3 class="font-semibold mb-3">QR Code</h3>
                            @if(!$isWhatsAppConnected && !empty($qrCode))
                                <img src="{{ $qrCode }}" alt="QR Code WhatsApp" class="w-64 h-64" />
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Scannez ce QR pour lier l'appareil.</p>
                            @else
                                <p class="text-gray-600 dark:text-gray-400">{{ $isWhatsAppConnected ? 'WhatsApp est connecté.' : 'QR non disponible.' }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="p-4 border border-gray-200 dark:border-gray-700 rounded bg-white dark:bg-gray-800 lg:col-span-2">
                            <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-4">
                                <div class="relative w-full md:w-2/3">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                        </svg>
                                    </div>
                                    <form method="GET" action="{{ route('whatsapp.index') }}">
                                        <input name="q" value="{{ $q }}" placeholder="Rechercher un employé..."
                                            class="w-full pl-10 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 transition duration-200" />
                                    </form>
                                </div>
                            </div>

                            <div class="relative overflow-x-auto shadow-sm sm:rounded-lg">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">#</th>
                                            <th scope="col" class="px-6 py-3">Prénom</th>
                                            <th scope="col" class="px-6 py-3">Nom</th>
                                            <th scope="col" class="px-6 py-3">Téléphone</th>
                                            <th scope="col" class="px-6 py-3">Identifiant</th>
                                            <th scope="col" class="px-6 py-3 text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($employees as $emp)
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                <td class="px-6 py-4">{{ $emp->id }}</td>
                                                <td class="px-6 py-4">{{ $emp->prenom }}</td>
                                                <td class="px-6 py-4">{{ $emp->nom }}</td>
                                                <td class="px-6 py-4">{{ $emp->telephone }}</td>
                                                <td class="px-6 py-4">{{ $emp->identifiant }}</td>
                                                <td class="px-6 py-4 text-right">
                                                    <button onclick="selectEmployee({ id: {{ $emp->id }}, prenom: '{{ addslashes($emp->prenom) }}', nom: '{{ addslashes($emp->nom) }}' })" class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                        Choisir
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">Aucun employé trouvé.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="px-2 py-3">
                                {{ $employees->links('vendor.pagination.tailwind') }}
                            </div>
                        </div>

                        <div class="p-4 border border-gray-200 dark:border-gray-700 rounded bg-white dark:bg-gray-800">
                            <h3 class="font-semibold mb-4">Envoyer un message</h3>
                            <div class="mb-2 text-sm text-gray-600 dark:text-gray-400">
                                Employé sélectionné: <span id="selected_employee_label" class="font-medium">aucun</span>
                            </div>
                            <form method="POST" action="{{ route('whatsapp.send.employee', ['employee' => 0]) }}" onsubmit="event.preventDefault(); sendToEmployee();">
                                @csrf
                                <input id="employee_id" type="hidden">
                                <div class="space-y-3">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Modèle</label>
                                        <select id="template_select" class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded p-2 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200" onchange="applyTemplate()">
                                            <option value="">Personnalisé (vide)</option>
                                            <option value="Rappel">Rappel générique</option>
                                            <option value="Mission">Message de mission</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Message</label>
                                        <textarea id="employee_message" rows="8" class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded p-3 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500" placeholder="Votre message personnalisé..." oninput="updateSendState()"></textarea>
                                        <div class="mt-1 text-xs text-gray-500 dark:text-gray-400"><span id="char_count">0</span> caractères</div>
                                    </div>
                                    <button id="send_btn" type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 disabled:opacity-60 disabled:cursor-not-allowed" disabled>
                                        <svg id="send_spinner" class="hidden animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                                        </svg>
                                        Envoyer
                                    </button>
                                    <div id="employee_result" class="text-sm mt-2"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>

    <script>
        let selectedEmployee = null;
        function selectEmployee(emp) {
            selectedEmployee = emp;
            document.getElementById('employee_id').value = emp.id;
            const displayName = `${emp.prenom || ''} ${emp.nom || ''}`.trim() || `#${emp.id}`;
            document.getElementById('selected_employee_label').textContent = `#${emp.id} - ${displayName}`;
            updateSendState();
        }

        function applyTemplate() {
            const sel = document.getElementById('template_select').value;
            const textarea = document.getElementById('employee_message');
            let text = '';
            if (sel === 'Rappel') {
                text = 'Bonjour {prenom} {nom}, ceci est un rappel. Merci.';
            } else if (sel === 'Mission') {
                text = 'Bonjour {prenom}, votre mission commence demain à 08:00. Bonne journée.';
            }
            if (text) {
                if (selectedEmployee) {
                    text = text.replaceAll('{prenom}', selectedEmployee.prenom || '')
                               .replaceAll('{nom}', selectedEmployee.nom || '');
                }
                textarea.value = text.trim();
            } else {
                textarea.value = '';
            }
            updateSendState();
        }

        function updateSendState() {
            const id = document.getElementById('employee_id').value;
            const message = document.getElementById('employee_message').value || '';
            const btn = document.getElementById('send_btn');
            const countEl = document.getElementById('char_count');
            countEl.textContent = message.length;
            btn.disabled = !(id && message.trim().length > 0);
        }

        async function sendToEmployee() {
            const id = document.getElementById('employee_id').value;
            const message = document.getElementById('employee_message').value;
            const resultEl = document.getElementById('employee_result');
            const btn = document.getElementById('send_btn');
            const spinner = document.getElementById('send_spinner');
            resultEl.textContent = 'Envoi en cours...';
            resultEl.className = 'text-sm mt-2 text-gray-600';
            btn.disabled = true;
            spinner.classList.remove('hidden');
            try {
                const res = await fetch(`/whatsapp/employees/${id}/send`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ message })
                });
                const data = await res.json();
                if (data.success) {
                    resultEl.textContent = 'Message envoyé.';
                    resultEl.className = 'text-sm mt-2 text-green-600';
                } else {
                    resultEl.textContent = data.message || data.error || 'Erreur.';
                    resultEl.className = 'text-sm mt-2 text-red-600';
                }
            } catch (e) {
                resultEl.textContent = 'Erreur réseau.';
                resultEl.className = 'text-sm mt-2 text-red-600';
            } finally {
                spinner.classList.add('hidden');
                updateSendState();
            }
        }
        
        // Initial state
        updateSendState();
    </script>
</x-app-layout>


