@extends('layouts.app')

@section('title', 'Profil')
@section('header', 'Profil Utilisateur')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white p-8 rounded-lg shadow-lg">
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Photo de profil -->
                <div class="md:col-span-1">
                    <div class="flex flex-col items-center space-y-4">
                        <div class="relative">
                            <img id="profileImage" 
                                src="{{ asset('storage/' . auth()->user()->photo) }}" 
                                alt="Photo de profil"
                                class="w-40 h-40 rounded-full object-cover border-4 border-pink-200 shadow-lg transition-all duration-300 hover:border-pink-300">
                            <input type="file" id="uploadImage" name="photo" class="hidden" accept="image/*">
                            <label for="uploadImage" 
                                class="absolute bottom-2 right-2 bg-pink-600 text-white p-2 rounded-full cursor-pointer shadow-md hover:bg-pink-700 transition-colors duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </label>
                        </div>
                        <p class="text-sm text-gray-500">Cliquez sur l'icône pour changer votre photo</p>
                    </div>
                </div>

                <!-- Informations personnelles -->
                <div class="md:col-span-2 space-y-6">
                    <h2 class="text-xl font-semibold text-pink-700 mb-4">Informations Personnelles</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-pink-700">Nom d'utilisateur</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <input type="text" id="name" name="name" 
                                    value="{{ auth()->user()->name }}"
                                    class="block w-full pl-10 pr-3 py-2 border border-pink-300 rounded-md focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-pink-700">Adresse email</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                    </svg>
                                </div>
                                <input type="email" id="email" name="email" 
                                    value="{{ auth()->user()->email }}"
                                    class="block w-full pl-10 pr-3 py-2 border border-pink-300 rounded-md focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                            </div>
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-pink-700">Numéro de téléphone</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <input type="tel" id="phone" name="phone" 
                                    value="{{ auth()->user()->phone ?? '' }}"
                                    class="block w-full pl-10 pr-3 py-2 border border-pink-300 rounded-md focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-sm"
                                    placeholder="+212 XXX-XXXXXX">
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-6 mt-6">
                        <h3 class="text-lg font-medium text-pink-700 mb-4">Changer le mot de passe</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-pink-700">Mot de passe actuel</label>
                                <input type="password" id="current_password" name="current_password" 
                                    class="mt-1 block w-full border border-pink-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                            </div>

                            <div>
                                <label for="new_password" class="block text-sm font-medium text-pink-700">Nouveau mot de passe</label>
                                <input type="password" id="new_password" name="new_password" 
                                    class="mt-1 block w-full border border-pink-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                            </div>

                            <div>
                                <label for="new_password_confirmation" class="block text-sm font-medium text-pink-700">Confirmer le nouveau mot de passe</label>
                                <input type="password" id="new_password_confirmation" name="new_password_confirmation" 
                                    class="mt-1 block w-full border border-pink-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-4 mt-8">
                <a href="{{ route('dashboard') }}" 
                    class="inline-flex items-center px-4 py-2 border border-pink-300 text-pink-700 rounded-md hover:bg-pink-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Annuler
                </a>
                <button type="submit" 
                        class="inline-flex items-center px-6 py-2 bg-pink-600 text-white rounded-md hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transform transition-all duration-200 hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('uploadImage').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profileImage').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});
</script>
@endsection
