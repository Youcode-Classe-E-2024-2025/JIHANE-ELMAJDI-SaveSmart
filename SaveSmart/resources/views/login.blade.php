<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SaveSmart - Connexion</title>
    @vite('resources/css/app.css')
    <style>
        .animate-fade-up { animation: fadeUp 0.6s ease-out; }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-pink-100 to-pink-200">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 animate-fade-up">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-pink-800">
                    Connectez-vous à votre compte
                </h2>
                <p class="mt-2 text-center text-sm text-pink-600">
                    Ou
                    <a href="{{ route('register') }}" class="font-medium text-pink-500 hover:text-pink-700 transition-colors duration-200">
                        créez un compte gratuitement
                    </a>
                </p>
            </div>

            @if ($errors->any())
            <div class="rounded-md bg-pink-50 p-4 border border-pink-200">
                <div class="flex">
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-pink-800">
                            Des erreurs sont survenues :
                        </h3>
                        <div class="mt-2 text-sm text-pink-700">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="email" class="sr-only">Adresse email</label>
                        <input id="email" name="email" type="email" required 
                               value="{{ old('email') }}"
                               class="appearance-none rounded-none relative block w-full px-3 py-2 border border-pink-300 placeholder-pink-400 text-gray-900 rounded-t-md focus:outline-none focus:ring-pink-500 focus:border-pink-500 focus:z-10 sm:text-sm transition-colors duration-200"
                               placeholder="Adresse email">
                    </div>
                    <div>
                        <label for="password" class="sr-only">Mot de passe</label>
                        <input id="password" name="password" type="password" required
                               class="appearance-none rounded-none relative block w-full px-3 py-2 border border-pink-300 placeholder-pink-400 text-gray-900 rounded-b-md focus:outline-none focus:ring-pink-500 focus:border-pink-500 focus:z-10 sm:text-sm transition-colors duration-200"
                               placeholder="Mot de passe">
                    </div>
                </div>

                <div>
                    <button type="submit"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transform transition-all duration-200 hover:scale-105">
                        Se connecter
                    </button>
                </div>
            </form>

            <div class="text-center">
                <a href="{{ route('home') }}" class="text-sm text-pink-600 hover:text-pink-800 transition-colors duration-200">
                    ← Retour à l'accueil
                </a>
            </div>
        </div>
    </div>
</body>
</html>
