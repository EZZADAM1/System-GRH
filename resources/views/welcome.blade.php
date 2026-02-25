<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GRH System - Gestion des Ressources Humaines</title>

    <linkpreconnect href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 text-gray-800 font-sans">

    <nav class="flex items-center justify-between px-6 py-4 bg-white shadow-sm">
        <div class="flex items-center">
            <svg class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
            <span class="ml-3 text-xl font-bold text-gray-900 tracking-tight">GRH System</span>
        </div>

        <div>
            @if (Route::has('login'))
                <div class="space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-700 hover:text-indigo-600 transition">
                            Tableau de bord
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-indigo-600 transition">
                            Se connecter
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition shadow">
                                S'inscrire
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </nav>

    <header class="bg-white">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                La gestion RH, <span class="text-indigo-600">simplifiée.</span>
            </h1>
            <p class="mt-4 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                Gérez vos employés, suivez les congés et générez vos fiches de paie en quelques clics. Une solution intuitive pour les entreprises modernes.
            </p>
            <div class="mt-8 flex justify-center gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg shadow-lg">
                        Accéder à mon Espace
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg shadow-lg">
                        Commencer maintenant
                    </a>
                    <a href="#features" class="px-8 py-3 border border-gray-300 text-base font-medium rounded-md text-indigo-700 bg-white hover:bg-gray-50 md:py-4 md:text-lg">
                        En savoir plus
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <section id="features" class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Fonctionnalités</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Tout ce dont vous avez besoin
                </p>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                
                <div class="bg-white overflow-hidden shadow rounded-lg p-6 text-center hover:shadow-lg transition duration-300">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white mx-auto mb-4">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Gestion des Employés</h3>
                    <p class="mt-2 text-base text-gray-500">
                        Base de données centralisée. Suivez les contrats, les salaires et les informations personnelles.
                    </p>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg p-6 text-center hover:shadow-lg transition duration-300">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white mx-auto mb-4">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Gestion des Congés</h3>
                    <p class="mt-2 text-base text-gray-500">
                        Demandes en ligne, workflow de validation (Approbation/Refus) et suivi des soldes.
                    </p>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg p-6 text-center hover:shadow-lg transition duration-300">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white mx-auto mb-4">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Fiches de Paie</h3>
                    <p class="mt-2 text-base text-gray-500">
                        Génération automatique des bulletins de paie au format PDF téléchargeable.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <footer class="bg-white border-t border-gray-200 mt-12">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-gray-400 text-sm">
                &copy; {{ date('Y') }} GRH System. Tous droits réservés. Projet Laravel.
            </p>
        </div>
    </footer>

</body>
</html>