@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('header', 'Tableau de bord')

@section('content')
<!-- Cartes de statistiques -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow duration-300 transform hover:scale-[1.02] transition-transform">
        <h3 class="text-lg font-medium text-pink-800">Revenus totaux</h3>
        <p class="text-3xl font-bold text-pink-600">{{ number_format($totalIncome, 2) }} €</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow duration-300 transform hover:scale-[1.02] transition-transform">
        <h3 class="text-lg font-medium text-pink-800">Dépenses totales</h3>
        <p class="text-3xl font-bold text-pink-500">{{ number_format($totalExpenses, 2) }} €</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow duration-300 transform hover:scale-[1.02] transition-transform">
        <h3 class="text-lg font-medium text-pink-800">Solde</h3>
        <p class="text-3xl font-bold {{ ($totalIncome - $totalExpenses) >= 0 ? 'text-pink-600' : 'text-pink-500' }}">
            {{ number_format($totalIncome - $totalExpenses, 2) }} €
        </p>
    </div>
</div>

<!-- Graphiques -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Graphique en donut des dépenses par catégorie -->
    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow duration-300">
        <h3 class="text-lg font-medium text-pink-800 mb-4">Répartition des dépenses</h3>
        <canvas id="expensesChart"></canvas>
    </div>
    <!-- Graphique en barres des revenus vs dépenses -->
    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow duration-300">
        <h3 class="text-lg font-medium text-pink-800 mb-4">Revenus vs Dépenses</h3>
        <canvas id="balanceChart"></canvas>
    </div>
</div>

<!-- Transactions récentes -->
<div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
    <div class="p-6 border-b border-pink-100">
        <h2 class="text-xl font-semibold text-pink-800">Transactions récentes</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-pink-100">
            <thead class="bg-pink-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-pink-700 uppercase">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-pink-700 uppercase">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-pink-700 uppercase">Catégorie</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-pink-700 uppercase">Montant</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-pink-100">
                @foreach($recentTransactions as $transaction)
                <tr class="hover:bg-pink-50 transition-colors duration-150">
                    <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->date->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $transaction->type === 'income' ? 'bg-pink-100 text-pink-800' : 'bg-pink-200 text-pink-800' }}">
                            {{ $transaction->type === 'income' ? 'Revenu' : 'Dépense' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->category->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap font-medium 
                        {{ $transaction->type === 'income' ? 'text-pink-600' : 'text-pink-500' }}">
                        {{ number_format($transaction->amount, 2) }} €
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="p-4 border-t border-pink-100">
        <a href="{{ route('transactions.index') }}" class="text-pink-600 hover:text-pink-800 transition-colors duration-200">
            Voir toutes les transactions →
        </a>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Configuration des couleurs pour les graphiques - palette de roses
    const colors = [
        '#4F46E5', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6', 
        '#EC4899', '#14B8A6', '#F97316', '#06B6D4', '#6366F1'
    ];
    
    // Graphique des dépenses par catégorie
    const expensesCtx = document.getElementById('expensesChart').getContext('2d');
    new Chart(expensesCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($expensesByCategory->keys()) !!},
            datasets: [{
                data: {!! json_encode($expensesByCategory->values()) !!},
                backgroundColor: colors,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    });

    // Graphique revenus vs dépenses
    const balanceCtx = document.getElementById('balanceChart').getContext('2d');
    new Chart(balanceCtx, {
        type: 'bar',
        data: {
            labels: ['Vue d\'ensemble'],
            datasets: [
                {
                    label: 'Revenus',
                    data: [{{ $totalIncome }}],
                    backgroundColor: '#10B981',
                },
                {
                    label: 'Dépenses',
                    data: [{{ $totalExpenses }}],
                    backgroundColor: '#EF4444',
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            animation: {
                duration: 1000,
                easing: 'easeInOutQuart'
            }
        }
    });
</script>
@endsection
