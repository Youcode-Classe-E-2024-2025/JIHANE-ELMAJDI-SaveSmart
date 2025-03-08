<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <style>
        .animate-fade-up { animation: fadeUp 0.6s ease-out; }
        .animate-scale { animation: scale 0.3s ease-out; }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes scale {
            from { transform: scale(0.95); }
            to { transform: scale(1); }
        }
        .input-focus-effect:focus {
            box-shadow: 0 0 0 2px #FDF2F8, 0 0 0 4px #EC4899;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-pink-100 to-pink-200 flex items-center justify-center min-h-screen">
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-md w-full animate-fade-up">
        <h2 class="text-2xl font-bold text-center text-pink-800 mb-6">Créer un compte</h2>
        <form action="{{ url('/register') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="username" class="block text-pink-700 font-semibold mb-2">Nom d'utilisateur</label>
                <input type="text" name="name" id="username" 
                    class="w-full px-4 py-2 border border-pink-300 rounded-lg focus:outline-none input-focus-effect transition-all duration-200 placeholder-pink-300" 
                    placeholder="Entrez votre nom d'utilisateur" required>
                <p class="text-pink-500 text-sm mt-2 hidden" id="usernameError">Le nom d'utilisateur est requis.</p>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-pink-700 font-semibold mb-2">Email</label>
                <input type="email" name="email" id="email" 
                    class="w-full px-4 py-2 border border-pink-300 rounded-lg focus:outline-none input-focus-effect transition-all duration-200 placeholder-pink-300" 
                    placeholder="Entrez votre email" required>
                <p class="text-pink-500 text-sm mt-2 hidden" id="emailError">Veuillez entrer un email valide.</p>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-pink-700 font-semibold mb-2">Mot de passe</label>
                <input type="password" name="password" id="password" 
                    class="w-full px-4 py-2 border border-pink-300 rounded-lg focus:outline-none input-focus-effect transition-all duration-200 placeholder-pink-300" 
                    placeholder="Entrez votre mot de passe" required>
                <p class="text-pink-500 text-sm mt-2 hidden" id="passwordError">Le mot de passe est requis.</p>
            </div>
            <div class="mb-6">
                <label for="confirm-password" class="block text-pink-700 font-semibold mb-2">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" id="confirm-password" 
                    class="w-full px-4 py-2 border border-pink-300 rounded-lg focus:outline-none input-focus-effect transition-all duration-200 placeholder-pink-300" 
                    placeholder="Confirmez votre mot de passe" required>
                <p class="text-pink-500 text-sm mt-2 hidden" id="confirmPasswordError">Les mots de passe ne correspondent pas.</p>
            </div>
            <button type="submit" 
                class="w-full bg-pink-600 text-white py-3 rounded-lg font-semibold hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-opacity-50 transform transition-all duration-200 hover:scale-[1.02] animate-scale">
                S'inscrire
            </button>
        </form>
        <p class="text-center text-pink-600 mt-6">
            Vous avez déjà un compte? 
            <a href="{{ route('login') }}" class="text-pink-500 font-semibold hover:text-pink-700 transition-colors duration-200">
                Connectez-vous
            </a>
        </p>
    </div>
    <script>
        document.getElementById('registrationForm').addEventListener('submit', function(event) {
            event.preventDefault();
            
            // Clear previous error messages
            document.querySelectorAll('.text-pink-500').forEach(function(element) {
                element.classList.add('hidden');
            });
            
            let isValid = true;
            const username = document.getElementById('username').value;
            const email = document.getElementById('email').value;
            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            
            if (!username) {
                document.getElementById('usernameError').classList.remove('hidden');
                isValid = false;
            }
            if (!email || !emailPattern.test(email)) {
                document.getElementById('emailError').classList.remove('hidden');
                isValid = false;
            }
            if (!password) {
                document.getElementById('passwordError').classList.remove('hidden');
                isValid = false;
            }
            if (password !== confirmPassword) {
                document.getElementById('confirmPasswordError').classList.remove('hidden');
                isValid = false;
            }
            
            if (isValid) {
                this.submit();
            }
        });
    </script>
</body>
</html>