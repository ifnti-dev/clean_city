<x-app-layout>
    <x-slot>

        <div class="w-full flex justify-center items-center ">

            <div class="w-full ">
                <div class="h-40 bg-indigo-600 py-2 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-baseline">
                    <div class="flex justify-between  items-baseline ">
                        <h1 class="text-white font-medium text-2xl max-sm:pl-2 max-sm:text-xl">Details d'un produit
                        </h1>
                    </div>

                  <div class="flex items-center gap-2 w-60 max-sm:w-full">
                        <a href="{{ route('produits.index') }}" class="w-full">
                            <x-primary-button class="w-full justify-center">
                                Liste
                            </x-primary-button>
                        </a>
                        <a href="{{ route('produits.edit', $produit->id) }}" class="w-full">
                            <x-primary-button class="w-full justify-center bg-yellow-700 hover:bg-yellow-600">
                                Modifier
                            </x-primary-button>
                        </a>
                    </div>
                </div>

                <div class="card  mt-[-50px] p-5 mx-4 mb-6 ">

                    <div class="border-b border-gray-200 pb-4 mb-6">
                        <h2 class="text-xl font-semibold text-gray-800">
                            Informations d'un produit
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <p class="text-lg text-gray-500">Label</p>
                            <p class="mt-1 font-medium text-gray-800">
                                {{ $produit->label }}
                            </p>
                        </div>

                        <div>
                            <p class="text-lg text-gray-500">Est en stock</p>
                            <p class="mt-1 font-medium text-gray-800">
                                @if($produit->est_en_stock) 
                                    <p><span class="bg-green-200 px-2 py-1 text-green-900 text-sm font-medium rounded-md inline-block">Oui</span></p>
                                @else
                                    <p><span class="bg-red-200 px-2 py-1 text-red-900 text-sm font-medium rounded-md inline-block">Non</span></p>
                                @endif

                            </p>
                        </div>

                        <div>
                            <p class="text-lg text-gray-500">prix_unitaire</p>
                            <p class="mt-1 font-medium text-gray-800">
                                {{ $produit->prix_unitaire }}
                            </p>
                        </div>

                        <div>
                            <p class="text-lg text-gray-500">Description</p>
                            <p class="mt-1 font-medium text-gray-800">
                                {{ $produit->description }}
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>   

`  
    </x-slot>

</x-app-layout>

