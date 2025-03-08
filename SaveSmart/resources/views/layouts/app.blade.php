<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SaveSmart - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .animate-fade-in { animation: fadeIn 0.5s ease-in; }
        .animate-slide-in { animation: slideIn 0.5s ease-out; }
        .hover-scale { transition: transform 0.2s; }
        .hover-scale:hover { transform: scale(1.05); }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideIn {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    </style>
    @yield('styles')
</head>
<body class="bg-pink-50">
    <div class="min-h-screen bg-pink-50 flex">
        <!-- Sidebar / Navigation -->
        <div class="w-64 bg-white shadow-lg animate-slide-in">
            <div class="flex items-center justify-center h-20 shadow-md bg-gradient-to-r from-pink-400 to-pink-600">
                <h1 class="text-2xl font-bold text-white">SaveSmart</h1>
            </div>
            <nav class="mt-4">
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center px-6 py-3 text-gray-700 hover:bg-pink-100 hover:text-pink-600 hover-scale {{ request()->routeIs('dashboard') ? 'bg-pink-100 text-pink-600' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Tableau de bord
                </a>

                <a href="{{ route('transactions.index') }}" 
                   class="flex items-center px-6 py-3 text-gray-700 hover:bg-pink-100 hover:text-pink-600 hover-scale {{ request()->routeIs('transactions.*') ? 'bg-pink-100 text-pink-600' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Transactions
                </a>

                <a href="{{ route('budget.optimization') }}" 
                   class="flex items-center px-6 py-3 text-gray-700 hover:bg-pink-100 hover:text-pink-600 hover-scale {{ request()->routeIs('budget.*') ? 'bg-pink-100 text-pink-600' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    Optimisation 50/30/20
                </a>

                <a href="{{ route('savings.index') }}" 
                   class="flex items-center px-6 py-3 text-gray-700 hover:bg-pink-100 hover:text-pink-600 hover-scale {{ request()->routeIs('savings.*') ? 'bg-pink-100 text-pink-600' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                    Objectifs d'épargne
                </a>

                <a href="{{ route('family.index') }}" 
                   class="flex items-center px-6 py-3 text-gray-700 hover:bg-pink-100 hover:text-pink-600 hover-scale {{ request()->routeIs('family.*') ? 'bg-pink-100 text-pink-600' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Comptes familiaux
                </a>

                <div class="px-6 py-3">
                    <div class="border-t border-gray-200"></div>
                </div>

                <div class="px-6 space-y-2">
                    <p class="text-xs font-semibold text-gray-600 uppercase">Exporter les données</p>
                    <a href="{{ route('export.pdf') }}" 
                       class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-pink-100 hover:text-pink-600 hover-scale rounded">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                        Exporter en PDF
                    </a>
                    <a href="{{ route('export.csv') }}" 
                       class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-pink-100 hover:text-pink-600 hover-scale rounded">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Exporter en CSV
                    </a>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Top bar -->
            <div class="bg-white shadow-sm animate-fade-in">
                <div class="flex justify-between items-center px-8 py-4">
                    <h2 class="text-xl font-semibold text-pink-800">@yield('header')</h2>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('profile') }}" class="text-pink-600 hover:text-pink-800 hover-scale">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-pink-600 hover:text-pink-800 hover-scale">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <div class="p-8 animate-fade-in">
                @yield('content')
            </div>
        </div>
    </div>

    @yield('scripts')
</body>
</html>