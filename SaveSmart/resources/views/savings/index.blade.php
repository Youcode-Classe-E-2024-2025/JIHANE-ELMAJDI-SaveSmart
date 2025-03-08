@extends('layouts.app')

@section('title', 'Objectifs d\'épargne')
@section('header', 'Objectifs d\'épargne')

@section('content')
<div class="container mx-auto px-4">
    <!-- Formulaire de création -->
    <div class="bg-white rounded-lg shadow p-6 mb-8 hover:shadow-lg transition-shadow duration-300">
        <h2 class="text-xl font-semibold mb-4 text-pink-800">Nouvel objectif</h2>
        <form action="{{ route('savings.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-pink-700">Nom de l'objectif</label>
                    <input type="text" name="name" 
                        class="mt-1 block w-full rounded-md border-pink-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200 focus:ring-opacity-50 transition-colors duration-200"
                        required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-pink-700">Montant cible (€)</label>
                    <input type="number" name="target_amount" step="0.01" min="0"
                        class="mt-1 block w-full rounded-md border-pink-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200 focus:ring-opacity-50 transition-colors duration-200"
                        required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-pink-700">Date cible</label>
                    <input type="date" name="target_date" 
                        class="mt-1 block w-full rounded-md border-pink-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200 focus:ring-opacity-50 transition-colors duration-200">
                </div>
                <div>
                    <label class="block text-sm font-medium text-pink-700">Description</label>
                    <textarea name="description" rows="2"
                        class="mt-1 block w-full rounded-md border-pink-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200 focus:ring-opacity-50 transition-colors duration-200"></textarea>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" 
                    class="bg-pink-600 text-white px-6 py-2 rounded-md hover:bg-pink-700 transform transition-all duration-200 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-opacity-50">
                    Créer l'objectif
                </button>
            </div>
        </form>
    </div>

    <!-- Liste des objectifs -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($goals as $goal)
        <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-all duration-300 transform hover:scale-[1.02]">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="text-lg font-semibold text-pink-800">{{ $goal->name }}</h3>
                    @if($goal->status === 'completed')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-pink-100 text-pink-800">
                            Objectif atteint
                        </span>
                    @elseif($goal->status === 'cancelled')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                            Annulé
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-pink-100 text-pink-800">
                            En cours
                        </span>
                    @endif
                </div>
                @if($goal->status === 'in_progress')
                    <form action="{{ route('savings.cancel', $goal) }}" method="POST" class="inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" 
                                class="text-pink-600 hover:text-pink-800 transition-colors duration-200"
                                onclick="return confirm('Êtes-vous sûr de vouloir annuler cet objectif ?')">
                            Annuler
                        </button>
                    </form>
                @endif
            </div>

            <div class="mb-4">
                <div class="flex justify-between text-sm text-pink-600 mb-1">
                    <span>Progression</span>
                    <span>{{ $goal->progress_percentage }}%</span>
                </div>
                <div class="w-full bg-pink-100 rounded-full h-2.5">
                    <div class="bg-pink-500 h-2.5 rounded-full transition-all duration-1000" style="width: {{ $goal->progress_percentage }}%"></div>
                </div>
            </div>

            <div class="space-y-2 text-sm">
                <p class="flex justify-between">
                    <span class="text-pink-600">Montant cible:</span>
                    <span class="font-medium text-pink-800">{{ number_format($goal->target_amount, 2) }} €</span>
                </p>
                <p class="flex justify-between">
                    <span class="text-pink-600">Montant épargné:</span>
                    <span class="font-medium text-pink-800">{{ number_format($goal->current_amount, 2) }} €</span>
                </p>
                <p class="flex justify-between">
                    <span class="text-pink-600">Reste à épargner:</span>
                    <span class="font-medium text-pink-800">{{ number_format($goal->remaining_amount, 2) }} €</span>
                </p>
                @if($goal->target_date)
                <p class="flex justify-between">
                    <span class="text-pink-600">Jours restants:</span>
                    <span class="font-medium text-pink-800">{{ $goal->days_remaining }} jours</span>
                </p>
                @endif
            </div>

            @if($goal->status === 'in_progress')
            <form action="{{ route('savings.update', $goal) }}" method="POST" class="mt-4 pt-4 border-t border-pink-100">
                @csrf
                @method('PUT')
                <div class="flex space-x-2">
                    <input type="number" name="current_amount" 
                        value="{{ old('current_amount', $goal->current_amount) }}"
                        step="0.01" min="0"
                        class="flex-1 rounded-md border-pink-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200 focus:ring-opacity-50 transition-colors duration-200"
                        required>
                    <button type="submit" 
                        class="bg-pink-600 text-white px-4 py-2 rounded-md hover:bg-pink-700 transform transition-all duration-200 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-opacity-50">
                        Mettre à jour
                    </button>
                </div>
            </form>
            @endif

            @if($goal->description)
            <p class="mt-4 text-sm text-pink-600">{{ $goal->description }}</p>
            @endif
        </div>
        @endforeach

        @if($goals->isEmpty())
        <div class="col-span-full text-center py-12">
            <p class="text-pink-600">Vous n'avez pas encore d'objectif d'épargne.</p>
            <p class="text-pink-600 mt-2">Créez votre premier objectif en utilisant le formulaire ci-dessus.</p>
        </div>
        @endif
    </div>
</div>
@endsection