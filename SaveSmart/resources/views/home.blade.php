<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>SaveSmart</title>
</head>
<header class="sticky inset-0 z-50 border-b border-slate-100 bg-white/80 backdrop-blur-lg">
    <nav class="mx-auto flex max-w-6xl gap-8 px-6 transition-all duration-200 ease-in-out lg:px-12 py-4">
        <div class="relative flex items-center">
            <a href="/">
                <img  src="https://www.svgrepo.com/show/499831/target.svg" loading="lazy" style="color:transparent" width="32" height="32"></a>
        </div>
        <ul class="hidden items-center justify-center gap-6 md:flex">
            <li class="pt-1.5 font-dm text-sm font-medium text-slate-700">
                <a href="#">Pricing</a>
            </li>
            <li class="pt-1.5 font-dm text-sm font-medium text-slate-700">
                <a href="#">Blog</a>
            </li>
            <li class="pt-1.5 font-dm text-sm font-medium text-slate-700">
                <a href="#">Docs</a>
            </li>
        </ul>
        <div class="flex-grow"></div>
        <div class="hidden items-center justify-center gap-6 md:flex">
            <a href="#" class="font-dm text-sm font-medium text-slate-700">Sign in</a>
            <a href="#"
                class="rounded-md bg-gradient-to-br from-green-600 to-emerald-400 px-3 py-1.5 font-dm text-sm font-medium text-white shadow-md shadow-green-400/50 transition-transform duration-200 ease-in-out hover:scale-[1.03]">Sign
                up for free
            </a>
        </div>
        <div class="relative flex items-center justify-center md:hidden">
            <button type="button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="h-6 w-auto text-slate-900"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path></svg>
            </button>
        </div>
    </nav>
</header>
<body>
    <main>
        <!-- https://gist.github.com/goodreds/3d044027175954984fb96c7407a955ab -->

<!-- Container -->
<div class="relative flex flex-col items-center mx-auto lg:flex-row-reverse lg:max-w-5xl lg:mt-12 xl:max-w-6xl">

    <!-- Image Column -->
    <div class="w-full h-64 lg:w-1/2 lg:h-auto">
        <img class="h-full w-full object-cover" src="https://images.pexels.com/photos/271168/pexels-photo-271168.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Winding mountain road">
    </div>
    <!-- Close Image Column -->

    <!-- Text Column -->
    <div
        class="max-w-lg bg-white md:max-w-2xl md:z-10 md:shadow-lg md:absolute md:top-0 md:mt-48 lg:w-3/5 lg:left-0 lg:mt-20 lg:ml-20 xl:mt-24 xl:ml-12">
        <!-- Text Wrapper -->
        <div class="flex flex-col p-12 md:px-16">
            <h2 class="text-2xl font-medium uppercase text-green-800 lg:text-4xl">SaveSmart</h2>
            <p class="mt-4">
                Prenez le contrôle de vos finances avec SaveSmart, l'outil simple et efficace pour gérer votre budget familial. Grâce à des fonctionnalités pratiques comme le suivi des revenus, des dépenses, et des objectifs d'épargne, SaveSmart vous aide à optimiser votre gestion financière au quotidien. Que vous soyez débutant ou confirmé, notre interface intuitive vous permet de visualiser facilement vos finances, d'ajouter des catégories personnalisées et de suivre vos progrès. Avec des outils d'optimisation budgétaire et des exports de données, atteignez vos objectifs financiers avec confiance et sérénité.
            </p>
            
        </div>
        <!-- Close Text Wrapper -->
    </div>
    <!-- Close Text Column -->

</div>
    </main>
</body>
</html>