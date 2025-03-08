@extends('layouts.app')

@section('title', 'Optimisation Budgétaire')

@section('header', 'Optimisation Budgétaire')

@section('styles')
<style>
    .progress-ring { transform: rotate(-90deg); }
    .card-animate { transition: all 0.3s ease-in-out; }
    .card-animate:hover { transform: translateY(-5px); }
    @keyframes progressFill {
        from { width: 0%; }
        to { width: var(--target-width); }
    }
    .progress-animate { animation: progressFill 1.5s ease-out forwards; }
</style>
@endsection

@section('content')
<p class="text-pink-600 mb-8 font-medium">Analyse selon la règle 50/30/20</p>

<!-- Vue d'ensemble -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Graphique de répartition actuelle -->
    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow duration-300 card-animate">
        <h2 class="text-xl font-semibold mb-4 text-pink-800">Répartition actuelle</h2>
        <canvas id="currentDistributionChart"></canvas>
    </div>

    <!-- Graphique de répartition optimale -->
    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow duration-300 card-animate">
        <h2 class="text-xl font-semibold mb-4 text-pink-800">Répartition recommandée</h2>
        <canvas id="optimalDistributionChart"></canvas>
    </div>
</div>

<!-- Détails par catégorie -->
<div class="bg-white rounded-lg shadow overflow-hidden mb-8 hover:shadow-lg transition-shadow duration-300">
    <div class="p-6 border-b border-pink-100">
        <h2 class="text-xl font-semibold text-pink-800">Analyse détaillée</h2>
        <p class="text-pink-600 mt-1">Revenu mensuel : {{ number_format($monthlyIncome, 2) }} €</p>
    </div>
    <div class="divide-y divide-pink-100">
        <!-- Besoins essentiels (50%) -->
        <div class="p-6">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="text-lg font-medium text-pink-800">Besoins essentiels (50%)</h3>
                    <p class="text-sm text-pink-600">Logement, alimentation, transport, santé</p>
                </div>
                <div class="text-right">
                    <p class="font-medium text-pink-700">Actuel: {{ number_format($analysis['current']['needs'], 2) }} €</p>
                    <p class="text-sm text-pink-600">Optimal: {{ number_format($analysis['optimal']['needs'], 2) }} €</p>
                </div>
            </div>
            <div class="w-full bg-pink-100 rounded-full h-2.5">
                @php
                    $needsPercentage = $analysis['optimal']['needs'] > 0 
                        ? ($analysis['current']['needs'] / $analysis['optimal']['needs']) * 100 
                        : 0;
                @endphp
                <div class="bg-pink-500 h-2.5 rounded-full progress-animate" 
                     style="--target-width: {{ min(100, $needsPercentage) }}%"></div>
            </div>
        </div>

        <!-- Envies (30%) -->
        <div class="p-6">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="text-lg font-medium text-pink-800">Dépenses non essentielles (30%)</h3>
                    <p class="text-sm text-pink-600">Loisirs, shopping, divertissement</p>
                </div>
                <div class="text-right">
                    <p class="font-medium text-pink-700">Actuel: {{ number_format($analysis['current']['wants'], 2) }} €</p>
                    <p class="text-sm text-pink-600">Optimal: {{ number_format($analysis['optimal']['wants'], 2) }} €</p>
                </div>
            </div>
            <div class="w-full bg-pink-100 rounded-full h-2.5">
                @php
                    $wantsPercentage = $analysis['optimal']['wants'] > 0 
                        ? ($analysis['current']['wants'] / $analysis['optimal']['wants']) * 100 
                        : 0;
                @endphp
                <div class="bg-pink-500 h-2.5 rounded-full progress-animate" 
                     style="--target-width: {{ min(100, $wantsPercentage) }}%"></div>
            </div>
        </div>

        <!-- Épargne (20%) -->
        <div class="p-6">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="text-lg font-medium text-pink-800">Épargne (20%)</h3>
                    <p class="text-sm text-pink-600">Épargne, investissements</p>
                </div>
                <div class="text-right">
                    <p class="font-medium text-pink-700">Actuel: {{ number_format($analysis['current']['savings'], 2) }} €</p>
                    <p class="text-sm text-pink-600">Optimal: {{ number_format($analysis['optimal']['savings'], 2) }} €</p>
                </div>
            </div>
            <div class="w-full bg-pink-100 rounded-full h-2.5">
                @php
                    $savingsPercentage = $analysis['optimal']['savings'] > 0 
                        ? ($analysis['current']['savings'] / $analysis['optimal']['savings']) * 100 
                        : 0;
                @endphp
                <div class="bg-pink-500 h-2.5 rounded-full progress-animate" 
                     style="--target-width: {{ min(100, $savingsPercentage) }}%"></div>
            </div>
        </div>
    </div>
</div>

<!-- Recommandations -->
@if(!empty($recommendations))
<div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
    <div class="p-6 border-b border-pink-100">
        <h2 class="text-xl font-semibold text-pink-800">Recommandations</h2>
    </div>
    <div class="p-6 space-y-4">
        @foreach($recommendations as $recommendation)
        <div class="flex items-start space-x-3 transform hover:translate-x-2 transition-transform duration-200">
            @if($recommendation['type'] === 'reduction')
                <svg class="h-6 w-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            @else
                <svg class="h-6 w-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            @endif
            <p class="flex-1 text-pink-700">{{ $recommendation['message'] }}</p>
        </div>
        @endforeach
    </div>
</div>
@endif
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Configuration des graphiques avec palette rose
    const colors = ['#EC4899', '#F472B6', '#F9A8D4'];
    
    const currentData = {
        labels: ['Besoins (50%)', 'Envies (30%)', 'Épargne (20%)'],
        datasets: [{
            data: [
                {{ $analysis['current']['needs'] }},
                {{ $analysis['current']['wants'] }},
                {{ $analysis['current']['savings'] }}
            ],
            backgroundColor: colors
        }]
    };

    const optimalData = {
        labels: ['Besoins (50%)', 'Envies (30%)', 'Épargne (20%)'],
        datasets: [{
            data: [
                {{ $analysis['optimal']['needs'] }},
                {{ $analysis['optimal']['wants'] }},
                {{ $analysis['optimal']['savings'] }}
            ],
            backgroundColor: colors
        }]
    };

    const options = {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            }
        },
        animation: {
            animateScale: true,
            animateRotate: true,
            duration: 2000,
            easing: 'easeInOutQuart'
        }
    };

    // Création des graphiques
    new Chart(document.getElementById('currentDistributionChart'), {
        type: 'doughnut',
        data: currentData,
        options: options
    });

    new Chart(document.getElementById('optimalDistributionChart'), {
        type: 'doughnut',
        data: optimalData,
        options: options
    });
</script>
@endsection