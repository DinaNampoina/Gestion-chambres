<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Hôtel Soavadia') }}</title>
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
            @include('layouts.navigation')

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
    </body>
</html>
