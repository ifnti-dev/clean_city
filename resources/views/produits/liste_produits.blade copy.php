<!DOCTYPE html>
<html lang="fr" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> </title>

    @vite(['resources/css/app.css', 'resources/css/style.css', 'resources/js/cart.js'])
</head>

<body>
    <div class="drawer drawer-end">
        <input id="my-drawer-4" type="checkbox" class="drawer-toggle" />

        <div class="drawer-content flex flex-col">
            <nav class="navbar bg-base-100 shadow-sm sticky top-0 z-50">

                <div class="flex-1">
                    <h3>Market place</h3>
                </div>

                <div class="flex gap-2">
                    <label for="my-drawer-4" class="btn btn-ghost btn-circle text-neutral">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </label>



                    <!-- list -->
                    @auth
                        <div class="flex gap-4">
                            <a href="{{ route('commandes.index') }}">
                                <x-third-button>Vos commandes</x-third-button>
                            </a>
                            <a href="{{ route('produits.index') }}">
                                <x-third-button>Administration</x-third-button>
                            </a>

                            <li class="dropdown ml-2">
                                <a class="rounded-full" href="#" role="button" id="dropdownUser"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="w-10 h-10 relative">
                                        <img alt="avatar" src="http://localhost:8000/assets/images/avatar/avatar-1.jpg"
                                            class="rounded-full" />
                                        <div
                                            class="absolute border-gray-200 border-2 rounded-full right-0 bottom-0 bg-green-600 h-3 w-3">

                                        </div>
                                    </div>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end p-2" aria-labelledby="dropdownUser">
                                    <div class="px-4 pb-0 pt-2">
                                        <div class="leading-4">
                                            <h5 class="mb-1">John E. Grainger</h5>
                                            <a href="#">View my profile</a>
                                        </div>
                                        <div class="border-b mt-3 mb-2"></div>
                                    </div>

                                    <ul class="list-unstyled">
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="w-4 h-4" data-feather="user"></i>
                                                Edit Profile
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="w-4 h-4" data-feather="activity"></i>
                                                Activity Log
                                            </a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="w-4 h-4" data-feather="star"></i>
                                                Go Pro
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="w-4 h-4" data-feather="settings"></i>
                                                Account Settings
                                            </a>
                                        </li>
                                        <li>
                                            <form action="{{ route('logout') }}" method="post">
                                                @csrf
                                                <button type="submit" class="dropdown-item" href="{{ route('logout') }}">
                                                    <i class="w-4 h-4" data-feather="power"></i>
                                                    Deconnexion
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </div>
                    @else
                        <div class="flex space-x-1">
                            <div>
                                <a href="{{ route('login') }}"><button> Se connecter </button></a>
                            </div><br>

                            <div>
                                <a href="{{ route('register') }}"><button> S'inscrire </button></a>
                            </div>
                        </div>
                    @endauth

                </div>
            </nav>

            <main>
                <div class="h-40 bg-indigo-600 py-2 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-baseline">
                    <div class="flex justify-between ml-4 mb-5">
                        <h1 class="text-white font-medium text-2xl max-sm:pl-2 max-sm:text-xl">Liste des produits</h1>
                    </div>
                </div>


                <div class=" card  mt-[-50px] p-5 mx-4 mb-6 ">
                    <form method="get" action="{{ route('listeArticle') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 ">
                            {{-- Recherche --}}
                            <div class="lg:col-span-2">
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">
                                    Recherche
                                </label>

                                <input type="text" name="search" id="search" value="{{ $search }}"
                                    placeholder="label, description"
                                    class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>

                        </div>

                        <div class="flex justify-end gap-3 mt-5">

                            <a href="{{ route('listeArticle') }}">
                                <x-secondary-button type="button"
                                    class="bg-gray-100 text-gray-700 border-gray-300 hover:bg-gray-200">
                                    Réinitialiser
                                </x-secondary-button>
                            </a>

                            <x-primary-button>
                                Filtrer
                            </x-primary-button>

                        </div>

                    </form>
                </div>



                <div class=" grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 ml-4">
                    @forelse ($produits as $produit)
                        <div class="card bg-base-100 shadow-sm">
                            <figure>
                                <img src="" alt="" />
                            </figure>
                            <div class="card-body">
                                <h2 class="card-title">{{ $produit->label }}</h2>
                                <p>{{ $produit->description }}</p>
                                <div class="card-actions justify-end">
                                    <x-primary-button class="add_" id="{{ $produit->id }}" data-label="{{ $produit->label }}">Ajouter au panier</x-primary-button>
                                </div>
                            </div>
                        </div>

                    @empty
                    @endforelse
                </div>

                <div class="p-4  ">
                    {{ $produits->links() }}
                </div>

            </main>


            <footer class="h-2 mt-auto">
                <div class="px-6 border-t  border-gray-300 py-3 flex justify-between items-center">
                    <p class="m-0 leading-6">
                        Made by
                        <a href="https://codescandy.com/" target="_blank" class="text-indigo-600">Codescandy</a>
                    </p>
                    <a href="https://github.com/codescandy/dashui-tailwindcss" target="_blank">
                        <svg viewBox="0 0 24 24" aria-hidden="true" class="h-6 w-6 fill-gray-800">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12 2C6.477 2 2 6.463 2 11.97c0 4.404 2.865 8.14 6.839 9.458.5.092.682-.216.682-.48 0-.236-.008-.864-.013-1.695-2.782.602-3.369-1.337-3.369-1.337-.454-1.151-1.11-1.458-1.11-1.458-.908-.618.069-.606.069-.606 1.003.07 1.531 1.027 1.531 1.027.892 1.524 2.341 1.084 2.91.828.092-.643.35-1.083.636-1.332-2.22-.251-4.555-1.107-4.555-4.927 0-1.088.39-1.979 1.029-2.675-.103-.252-.446-1.266.098-2.638 0 0 .84-.268 2.75 1.022A9.607 9.607 0 0 1 12 6.82c.85.004 1.705.114 2.504.336 1.909-1.29 2.747-1.022 2.747-1.022.546 1.372.202 2.386.1 2.638.64.696 1.028 1.587 1.028 2.675 0 3.83-2.339 4.673-4.566 4.92.359.307.678.915.678 1.846 0 1.332-.012 2.407-.012 2.734 0 .267.18.577.688.48 3.97-1.32 6.833-5.054 6.833-9.458C22 6.463 17.522 2 12 2Z">
                            </path>
                        </svg>
                    </a>
                </div>
            </footer>
        </div>

        <div class="drawer-side">
            <label for="my-drawer-4" aria-label="close sidebar" class="drawer-overlay"></label>
            <div class="menu bg-base-100 text-base-content min-h-full w-80 p-4">
                <h2 class="text-xl font-bold mb-4">Votre Panier</h2>
                <div class="bg-red-500 flex flex-row panier">

                </div>

                <form action="" method="post">
                    @csrf
                    <x-secondary-button class="w-full">Commander</x-secondary-button>
                    <input type="hidden" name="ligneCommandes" id="ligneCommandes">
                </form>
            </div>
        </div>

    </div>

</body>

</html>
