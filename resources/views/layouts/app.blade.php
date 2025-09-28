<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Gestion des Employés') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        <style>
            :root {
                --primary-color: #00714c;
                --primary-light: #e5f1ec;
                --white: #ffffff;
                --secondary: #eab308;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <!-- Scripts SweetAlert2 -->
        <script>
            // Fonction pour confirmer la finalisation d'une mission
            function confirmFinaliserMission(form) {
                Swal.fire({
                    title: 'Êtes-vous sûr?',
                    text: 'Voulez-vous vraiment finaliser cette mission?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#00714c',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui, finaliser',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }

            // Fonction pour confirmer la suppression d'un employé
            function confirmSupprimerEmploye(form) {
                Swal.fire({
                    title: 'Supprimer cet employé?',
                    text: 'Cette action est irréversible!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Oui, supprimer',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }

            // Fonction pour afficher une alerte d'erreur
            function showErrorAlert(message) {
                Swal.fire({
                    title: 'Erreur',
                    text: message,
                    icon: 'error',
                    confirmButtonColor: '#00714c'
                });
            }
        </script>
    </body>
</html>
