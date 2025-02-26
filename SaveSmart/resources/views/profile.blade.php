<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-purple-400 via-pink-400 to-blue-400 flex justify-center items-center h-screen">
    <div class="bg-white p-8 rounded-xl shadow-2xl w-96 text-center border-4 border-purple-500">
        <h2 class="text-3xl font-extrabold text-purple-700 mb-6">Profil Utilisateur</h2>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="relative w-32 h-32 mx-auto mb-6">
                <img id="profileImage" src="{{ asset('storage/' . auth()->user()->photo) }}" 
                     
                     class="w-full h-full rounded-full object-cover border-4 border-pink-500 shadow-lg transition-transform duration-300 hover:scale-105">
                <input type="file" id="uploadImage" name="photo" class="hidden" accept="image/*">
                <label for="uploadImage" class="absolute bottom-2 right-2 bg-blue-600 text-white p-2 rounded-full cursor-pointer shadow-md hover:bg-blue-700">
                    📷
                </label>
            </div>

            <div class="text-gray-700 space-y-2">
                <p class="text-lg font-semibold flex items-center justify-center">
                    <span class="mr-2">👤</span> 
                    <span id="userName">{{ auth()->user()->name }}</span>
                </p>
                <p class="text-lg font-semibold flex items-center justify-center">
                    <span class="mr-2">📧</span> 
                    <span id="userEmail">{{ auth()->user()->email }}</span>
                </p>
            </div>

            <button type="submit" class="mt-6 px-5 py-3 bg-purple-600 text-white font-semibold rounded-lg shadow-lg transition-all duration-300 hover:bg-purple-700 hover:shadow-xl">
                Appliquer
            </button>
        </form>

        <button onclick="location.href='dashbord'" 
                class="mt-4 px-5 py-3 bg-gray-500 text-white font-semibold rounded-lg shadow-lg transition-all duration-300 hover:bg-gray-600 hover:shadow-xl">
            Retour
        </button>
    </div>

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
</body>
</html>
