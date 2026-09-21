<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Gestion Hôtel') }}</title>
        <script>
            if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        </script>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-brand-50 dark:bg-brand-950">
            <nav x-data="{ open: false }" class="bg-white dark:bg-brand-900 border-b border-brand-200 dark:border-brand-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center gap-8">
                            <a href="{{ route('dashboard') }}" class="text-xl font-bold text-brand-700 dark:text-brand-400">🏨 Gestion Hôtel</a>
                            <div class="hidden sm:flex sm:gap-6">
                                <a href="{{ route('dashboard') }}" class="text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-brand-700 dark:text-brand-400' : 'text-gray-500 dark:text-gray-400' }}">Tableau de bord</a>
                                <a href="{{ route('chambres.index') }}" class="text-sm font-medium {{ request()->routeIs('chambres.*') ? 'text-brand-700 dark:text-brand-400' : 'text-gray-500 dark:text-gray-400' }}">Chambres</a>
                                <a href="{{ route('reservations.index') }}" class="text-sm font-medium {{ request()->routeIs('reservations.*') ? 'text-brand-700 dark:text-brand-400' : 'text-gray-500 dark:text-gray-400' }}">Réservations</a>
                                <a href="{{ route('accueil.create') }}" class="text-sm font-medium {{ request()->routeIs('accueil.*') ? 'text-brand-700 dark:text-brand-400' : 'text-gray-500 dark:text-gray-400' }}">Accueil</a>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <button id="theme-toggle" type="button" class="p-2 rounded-md text-accent-700 dark:text-accent-400 hover:bg-brand-50 dark:hover:bg-brand-800">
                                <svg id="theme-icon-dark" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                                <svg id="theme-icon-light" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                            </button>
                            <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                                <button @click="open = !open" class="text-sm text-gray-600 dark:text-gray-300 flex items-center gap-1">
                                    {{ auth()->user()->prenom }} {{ auth()->user()->nom }}
                                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                </button>
                                <div x-show="open" style="display:none" class="absolute right-0 mt-2 w-48 bg-white dark:bg-brand-800 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 py-1">
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-brand-50 dark:hover:bg-brand-700">Mon profil</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-brand-50 dark:hover:bg-brand-700">Déconnexion</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            @if (isset($header))
                <header class="bg-white dark:bg-brand-900 shadow-sm border-b border-brand-200 dark:border-brand-800">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">{{ $header }}</div>
                </header>
            @endif

            @if (session('success'))
                <div id="flash-message" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                    <div class="bg-brand-100 dark:bg-brand-800 text-brand-700 dark:text-brand-200 px-4 py-3 rounded-md flex justify-between items-center">
                        <span>{{ session('success') }}</span>
                        <button onclick="document.getElementById('flash-message').remove()" class="font-bold text-lg leading-none">&times;</button>
                    </div>
                </div>
                <script>setTimeout(() => { const el = document.getElementById('flash-message'); if (el) { el.style.transition='opacity .5s'; el.style.opacity='0'; setTimeout(() => el.remove(), 500); } }, 3000);</script>
            @endif

            @if (session('error'))
                <div id="flash-error" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                    <div class="bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-300 px-4 py-3 rounded-md flex justify-between items-center">
                        <span>{{ session('error') }}</span>
                        <button onclick="document.getElementById('flash-error').remove()" class="font-bold text-lg leading-none">&times;</button>
                    </div>
                </div>
            @endif

            <main>{{ $slot }}</main>
        </div>

        <script>
            const html = document.documentElement;
            const iconDark = document.getElementById('theme-icon-dark');
            const iconLight = document.getElementById('theme-icon-light');
            function applyTheme(isDark) {
                html.classList.toggle('dark', isDark);
                iconDark.classList.toggle('hidden', !isDark);
                iconLight.classList.toggle('hidden', isDark);
            }
            applyTheme(html.classList.contains('dark'));
            document.getElementById('theme-toggle').addEventListener('click', () => {
                const isDark = !html.classList.contains('dark');
                localStorage.setItem('theme', isDark ? 'dark' : 'light');
                applyTheme(isDark);
            });
        </script>
    </body>
</html>
