<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-56 bg-gradient-to-b from-purple-600 to-pink-500 text-white p-5 flex flex-col">
            <h2 class="text-xl font-bold mb-6">SaveSmart</h2>
            <nav class="flex-1">
                <ul>
                    <li class="mb-3"><a href="#" class="block p-2 hover:bg-purple-700 rounded">🏠 Dashboard</a></li>
                    <li class="mb-3"><a href="#" class="block p-2 hover:bg-purple-700 rounded">💰 Revenus</a></li>
                    <li class="mb-3"><a href="#" class="block p-2 hover:bg-purple-700 rounded">📉 Dépenses</a></li>
                    <li class="mb-3"><a href="#" class="block p-2 hover:bg-purple-700 rounded">🎯 Objectifs</a></li>
                </ul>
            </nav>
            <a href="home.blade.php" class="block p-2 bg-red-600 text-center rounded mt-4">🔒 Déconnexion</a>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <header class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Tableau de Bord</h1>
                <button onclick="location.href='profile'" class="bg-white p-2 rounded shadow-md">👤 Profil</button>
            </header>
            
            <!-- Stat Cards & Chart -->
            <div class="grid grid-cols-2 gap-6">
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-4 bg-white rounded shadow-md text-center">
                        <h2 class="text-lg font-semibold text-purple-600">💰 Revenus</h2>
                        <p class="text-xl font-bold">5,000 €</p>
                    </div>
                    <div class="p-4 bg-white rounded shadow-md text-center">
                        <h2 class="text-lg font-semibold text-pink-600">📉 Dépenses</h2>
                        <p class="text-xl font-bold">2,500 €</p>
                    </div>
                    <div class="p-4 bg-white rounded shadow-md text-center">
                        <h2 class="text-lg font-semibold text-purple-600">🎯 Objectifs</h2>
                        <p class="text-xl font-bold">80% atteint</p>
                    </div>
                </div>
                <div class="bg-white p-4 rounded shadow-md flex justify-center items-center">
                    <canvas id="budgetChart"></canvas>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('budgetChart').getContext('2d');
        var budgetChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Revenus', 'Dépenses', 'Épargne'],
                datasets: [{
                    data: [5000, 2500, 1000],
                    backgroundColor: ['#6B46C1', '#EC4899', '#9F7AEA']
                }]
            }
        });
    </script>
</body>
</html>
