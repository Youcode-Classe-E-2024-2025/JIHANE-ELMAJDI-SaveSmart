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
                <img src="https://www.svgrepo.com/show/499831/target.svg" loading="lazy" style="color:transparent"
                    width="32" height="32"></a>
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
            <a href="{{route('login')}}" class="font-dm text-sm font-medium text-slate-700">Se connecter</a>
            <a href="#"
                class="rounded-md bg-gradient-to-br from-green-600 to-emerald-400 px-3 py-1.5 font-dm text-sm font-medium text-white shadow-md shadow-green-400/50 transition-transform duration-200 ease-in-out hover:scale-[1.03]">
                s'inscrire
            </a>
        </div>
        <div class="relative flex items-center justify-center md:hidden">
            <button type="button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" aria-hidden="true" class="h-6 w-auto text-slate-900">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
                </svg>
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
                <img class="h-full w-full object-cover"
                    src="https://images.pexels.com/photos/271168/pexels-photo-271168.jpeg?auto=compress&cs=tinysrgb&w=600"
                    alt="Winding mountain road">
            </div>
            <!-- Close Image Column -->

            <!-- Text Column -->
            <div
                class="max-w-lg bg-white md:max-w-2xl md:z-10 md:shadow-lg md:absolute md:top-0 md:mt-48 lg:w-3/5 lg:left-0 lg:mt-20 lg:ml-20 xl:mt-24 xl:ml-12">
                <!-- Text Wrapper -->
                <div class="flex flex-col p-12 md:px-16">
                    <h2 class="text-2xl font-medium uppercase text-green-800 lg:text-4xl mb-50">SaveSmart</h2>
                    <p class="mt-4">
                        Prenez le contrôle de vos finances avec SaveSmart, l'outil simple et efficace pour gérer votre
                        budget familial. Grâce à des fonctionnalités pratiques comme le suivi des revenus, des dépenses,
                        et des objectifs d'épargne, SaveSmart vous aide à optimiser votre gestion financière au
                        quotidien. Que vous soyez débutant ou confirmé, notre interface intuitive vous permet de
                        visualiser facilement vos finances, d'ajouter des catégories personnalisées et de suivre vos
                        progrès. Avec des outils d'optimisation budgétaire et des exports de données, atteignez vos
                        objectifs financiers avec confiance et sérénité.
                    </p>

                </div>
                <!-- Close Text Wrapper -->
            </div>
            <!-- Close Text Column -->

        </div>
       
    </main>
    <main>
        <footer class="px-3 pt-4 lg:px-9 border-t-2 bg-gray-50 mt-20">
            <div class="grid gap-10 row-gap-6 mb-8 sm:grid-cols-2 lg:grid-cols-4">
        
                <div class="sm:col-span-2">
                    <a href="#" class="inline-flex items-center">
                        <img src="https://mcqmate.com/public/images/logos/60x60.png" alt="logo" class="h-8 w-8">
                        <span class="ml-2 text-xl font-bold tracking-wide text-gray-800">SaveSmart</span>
                    </a>
                    <div class="mt-6 lg:max-w-xl">
                        <p class="text-sm text-gray-800">
                            Prenez le contrôle de vos finances avec SaveSmart, l'outil simple et efficace pour gérer votre budget familial. Grâce à des fonctionnalités pratiques comme le suivi des revenus, des dépenses et des objectifs d'épargne, SaveSmart vous aide à optimiser votre gestion financière au quotidien. Que vous soyez débutant ou confirmé, notre interface intuitive vous permet de visualiser facilement vos finances, d'ajouter des catégories personnalisées et de suivre vos progrès. Avec des outils d'optimisation budgétaire et des exports de données, atteignez vos objectifs financiers avec confiance et sérénité.
                            </p>
                    </div>
                </div>
        
                <div class="flex flex-col gap-2 text-sm">
                    <p class="text-base font-bold tracking-wide text-gray-900">Popular Courses</p>
                    <a href="#">UPSC - Union Public Service Commission</a>
                    <a href="#">General Knowledge</a>
                    <a href="#">MBA</a>
                    <p class="text-base font-bold tracking-wide text-gray-900">Popular Topics</p>
                    <a href="#">Human Resource Management</a>
                    <a href="#">Operations Management</a>
                    <a href="#">Marketing Management</a>
                </div>
        
                <div>
                    <p class="text-base font-bold tracking-wide text-gray-900">COMPANY IS ALSO AVAILABLE ON</p>
                    <div class="flex items-center gap-1 px-2">
                        <a href="#" class="w-full min-w-xl mb-12">
                            <img src="https://mcqmate.com/public/images/icons/playstore.svg" alt="Playstore Button"
                                class="h-10">
                        </a>
                        <a class="w-full min-w-xl" href="https://www.youtube.com/channel/UCo8tEi6SrGFP8XG9O0ljFgA">
                            <img src="https://mcqmate.com/public/images/icons/youtube.svg" alt="Youtube Button"
                                class="h-28">
                        </a>
                    </div>
                    <p class="text-base font-bold tracking-wide text-gray-900">Contacts</p>
                    <div class="flex">
                        <p class="mr-1 text-gray-800">Email:</p>
                        <a href="#" title="send email">admin@company.com</a>
                    </div>
                </div>
        
            </div>
        
            <div class="flex flex-col-reverse justify-between pt-5 pb-10 border-t lg:flex-row">
                <p class="text-sm text-gray-600">© Copyright 2023 Company. All rights reserved.</p>
                <ul class="flex flex-col mb-3 space-y-2 lg:mb-0 sm:space-y-0 sm:space-x-5 sm:flex-row">
                    <li>
                        <a href="#"
                            class="text-sm text-gray-600 transition-colors duration-300 hover:text-deep-purple-accent-400">Privacy
                            &amp; Cookies Policy
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="text-sm text-gray-600 transition-colors duration-300 hover:text-deep-purple-accent-400">Disclaimer
                        </a>
                    </li>
                </ul>
            </div>
        
        </footer>
    </main>
</body>

</html>
