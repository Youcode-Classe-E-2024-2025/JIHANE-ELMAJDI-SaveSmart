@extends('layouts.app')

@section('title', 'Comptes Familiaux')
@section('header', 'Comptes Familiaux')

@section('content')
<div class="flex justify-between items-center mb-6">
    <a href="{{ route('family.create') }}" 
       class="bg-pink-600 text-white px-4 py-2 rounded-md hover:bg-pink-700 transform transition-all duration-200 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-opacity-50 inline-flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Nouveau compte familial
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($familyAccounts as $account)
    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-all duration-300 transform hover:scale-[1.02]">
        <div class="flex justify-between items-start mb-4">
            <div>
                <h2 class="text-xl font-semibold text-pink-800">{{ $account->name }}</h2>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $account->pivot->role === 'owner' ? 'bg-pink-100 text-pink-800' : 'bg-pink-50 text-pink-600' }}">
                    {{ $account->pivot->role === 'owner' ? 'Propriétaire' : 'Membre' }}
                </span>
            </div>
        </div>
        
        <div class="mt-4">
            <div class="flex items-center text-pink-600">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <p class="text-sm">{{ $account->members->count() }} membres</p>
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('family.show', $account) }}" 
               class="inline-flex items-center text-pink-600 hover:text-pink-800 transition-colors duration-200">
                Voir les détails
                <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
    @endforeach

    @if($familyAccounts->isEmpty())
    <div class="col-span-full text-center py-12">
        <div class="bg-white rounded-lg shadow p-8">
            <svg class="w-16 h-16 text-pink-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <p class="text-pink-600 mb-4">Vous n'avez pas encore de compte familial.</p>
            <a href="{{ route('family.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-pink-600 text-white rounded-md hover:bg-pink-700 transform transition-all duration-200 hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Créer votre premier compte familial
            </a>
        </div>
    </div>
    @endif
</div>
@endsection