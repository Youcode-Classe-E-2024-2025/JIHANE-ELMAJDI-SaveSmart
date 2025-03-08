@extends('layouts.app')

@section('title', $familyAccount->name)
@section('header', $familyAccount->name)

@section('content')
<div class="mb-8">
    <div class="flex justify-between items-start">
        <p class="text-pink-600">Gérez votre budget familial ensemble</p>
        <a href="{{ route('family.index') }}" 
           class="inline-flex items-center text-pink-600 hover:text-pink-800 transition-colors duration-200">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
            </svg>
            Retour aux comptes familiaux
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Liste des membres -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow hover:shadow-lg transition-all duration-300">
            <div class="p-6 border-b border-pink-100">
                <h2 class="text-xl font-semibold text-pink-800">Membres</h2>
            </div>
            <div class="p-6">
                @if($familyAccount->owner_id === auth()->id())
                <form action="{{ route('family.members.add', $familyAccount) }}" method="POST" class="mb-6">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-pink-700 mb-2">Ajouter un membre</label>
                        <div class="flex">
                            <input type="email" 
                                   name="email" 
                                   placeholder="Email du membre"
                                   class="flex-1 rounded-l-md border-pink-300 focus:border-pink-500 focus:ring focus:ring-pink-200 focus:ring-opacity-50">
                            <button type="submit" 
                                    class="bg-pink-600 text-white px-4 py-2 rounded-r-md hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-opacity-50 transition-colors duration-200">
                                Ajouter
                            </button>
                        </div>
                    </div>
                </form>
                @endif

                <ul class="divide-y divide-pink-100">
                    @foreach($members as $member)
                    <li class="py-4 flex justify-between items-center">
                        <div>
                            <p class="font-medium text-pink-800">{{ $member->name }}</p>
                            <p class="text-sm text-pink-600">{{ $member->email }}</p>
                        </div>
                        @if($familyAccount->owner_id === auth()->id() && $member->id !== auth()->id())
                        <form action="{{ route('family.members.remove', [$familyAccount, $member]) }}" 
                              method="POST" 
                              class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-pink-600 hover:text-pink-800 transition-colors duration-200"
                                    onclick="return confirm('Êtes-vous sûr de vouloir retirer ce membre ?')">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Statistiques et transactions -->
    <div class="lg:col-span-2">
        <!-- Totaux -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-all duration-300 transform hover:scale-[1.02]">
                <h3 class="text-lg font-medium text-pink-800">Total Revenus</h3>
                <p class="text-2xl font-bold text-pink-600">
                    {{ number_format($transactions->where('type', 'income')->sum('amount'), 2) }} €
                </p>
            </div>
            <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-all duration-300 transform hover:scale-[1.02]">
                <h3 class="text-lg font-medium text-pink-800">Total Dépenses</h3>
                <p class="text-2xl font-bold text-pink-500">
                    {{ number_format($transactions->where('type', 'expense')->sum('amount'), 2) }} €
                </p>
            </div>
            <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-all duration-300 transform hover:scale-[1.02]">
                <h3 class="text-lg font-medium text-pink-800">Balance</h3>
                @php
                    $balance = $transactions->where('type', 'income')->sum('amount') - 
                              $transactions->where('type', 'expense')->sum('amount');
                @endphp
                <p class="text-2xl font-bold {{ $balance >= 0 ? 'text-pink-600' : 'text-pink-500' }}">
                    {{ number_format($balance, 2) }} €
                </p>
            </div>
        </div>

        <!-- Liste des transactions -->
        <div class="bg-white rounded-lg shadow hover:shadow-lg transition-all duration-300">
            <div class="p-6 border-b border-pink-100">
                <h2 class="text-xl font-semibold text-pink-800">Transactions récentes</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-pink-100">
                    <thead class="bg-pink-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-pink-700 uppercase">Membre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-pink-700 uppercase">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-pink-700 uppercase">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-pink-700 uppercase">Montant</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-pink-700 uppercase">Catégorie</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-pink-100">
                        @foreach($transactions as $transaction)
                        <tr class="hover:bg-pink-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-pink-800">
                                {{ $transaction->user->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-pink-600">
                                {{ $transaction->date->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $transaction->type === 'income' ? 'bg-pink-100 text-pink-800' : 'bg-pink-200 text-pink-800' }}">
                                    {{ $transaction->type === 'income' ? 'Revenu' : 'Dépense' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium 
                                {{ $transaction->type === 'income' ? 'text-pink-600' : 'text-pink-500' }}">
                                {{ number_format($transaction->amount, 2) }} €
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-pink-600">
                                {{ $transaction->category }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-pink-100">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
</div>
@endsection