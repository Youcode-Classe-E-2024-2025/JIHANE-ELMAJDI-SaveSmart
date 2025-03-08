@extends('layouts.app')

@section('title', 'Nouveau Compte Familial')
@section('header', 'Nouveau Compte Familial')

@section('content')
<div class="max-w-2xl mx-auto">
    <p class="text-pink-600 mb-6">Créez un compte pour gérer vos finances en famille</p>

    <div class="bg-white rounded-lg shadow-lg p-8 hover:shadow-xl transition-all duration-300">
        <form action="{{ route('family.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-pink-700 mb-2">
                    Nom du compte familial
                </label>
                <div class="relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           class="block w-full pl-10 pr-3 py-2 border border-pink-300 rounded-md focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-sm transition-colors duration-200"
                           required
                           placeholder="Ex: Famille Dupont">
                </div>
                @error('name')
                    <p class="mt-2 text-sm text-pink-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('family.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-pink-300 text-pink-700 rounded-md hover:bg-pink-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
                    </svg>
                    Retour
                </a>
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 bg-pink-600 text-white rounded-md hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transform transition-all duration-200 hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Créer le compte familial
                </button>
            </div>
        </form>
    </div>
</div>
@endsection