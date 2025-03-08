@extends('layouts.app')

@section('title', 'Transactions')

@section('header', 'Transactions')

@section('content')
<div class="mb-6 flex justify-end">
    <div class="flex space-x-4">
        <a href="{{ route('export.csv') }}" 
           class="bg-pink-500 text-white px-4 py-2 rounded-md hover:bg-pink-600 flex items-center transform transition-all duration-200 hover:scale-105">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Exporter CSV
        </a>
        <a href="{{ route('export.pdf') }}" 
           class="bg-pink-600 text-white px-4 py-2 rounded-md hover:bg-pink-700 flex items-center transform transition-all duration-200 hover:scale-105">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Exporter PDF
        </a>
    </div>
</div>

<!-- Formulaire d'ajout de transaction -->
<div class="bg-white rounded-lg shadow p-6 mb-8 hover:shadow-lg transition-shadow duration-300">
    <h2 class="text-xl font-semibold mb-4 text-pink-800">Nouvelle Transaction</h2>
    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-pink-700">Montant</label>
                <input type="number" step="0.01" name="amount" 
                    class="mt-1 block w-full rounded-md border-pink-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200 focus:ring-opacity-50 transition-colors duration-200" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-pink-700">Type</label>
                <select name="type" 
                    class="mt-1 block w-full rounded-md border-pink-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200 focus:ring-opacity-50 transition-colors duration-200" required>
                    <option value="income">Revenu</option>
                    <option value="expense">Dépense</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-pink-700">Catégorie</label>
                <select name="category_id" 
                    class="mt-1 block w-full rounded-md border-pink-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200 focus:ring-opacity-50 transition-colors duration-200" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-pink-700">Date</label>
                <input type="date" name="date" 
                    class="mt-1 block w-full rounded-md border-pink-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200 focus:ring-opacity-50 transition-colors duration-200" required>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-pink-700">Description</label>
                <textarea name="description" 
                    class="mt-1 block w-full rounded-md border-pink-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200 focus:ring-opacity-50 transition-colors duration-200"></textarea>
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" 
                class="bg-pink-600 text-white px-6 py-2 rounded-md hover:bg-pink-700 transform transition-all duration-200 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-opacity-50">
                Ajouter la transaction
            </button>
        </div>
    </form>
</div>

<!-- Liste des transactions -->
<div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-pink-100">
            <thead class="bg-pink-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-pink-700 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-pink-700 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-pink-700 uppercase tracking-wider">Catégorie</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-pink-700 uppercase tracking-wider">Montant</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-pink-700 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-pink-700 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-pink-100">
                @foreach($transactions as $transaction)
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
                    <td class="px-6 py-4">{{ $transaction->description ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="text-pink-600 hover:text-pink-800 transition-colors duration-200"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette transaction ?')">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($transactions->isEmpty())
    <div class="text-center py-12">
        <p class="text-pink-600">Aucune transaction enregistrée.</p>
    </div>
    @endif
</div>
@endsection