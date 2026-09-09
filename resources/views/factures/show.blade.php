<x-app-layout>
    <x-slot>

        <div class="w-full flex justify-center items-center ">

            <div class="w-full ">
                <div class="h-40 bg-indigo-600 py-2 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-baseline">
                    <div class="flex justify-between  items-baseline ">
                        <h1 class="text-white font-medium text-2xl max-sm:pl-2 max-sm:text-xl">Details d'une facture
                        </h1>
                    </div>

                    <div class="flex items-center gap-1  w-40 max-sm:w-full">
                        <a href="{{ route('factures.index') }}" class="w-full">
                            <x-secondary-button class="bg-white text-black py-3  hover:bg-slate-50 w-full justify-center max-sm:py-2 max-sm:text-md" >
                                Liste
                            </x-secondary-button>
                        </a>
                    </div>    
                        {{-- <a href="{{ route('factures.edit', $facture->id) }}" class="w-full">
                            <x-primary-button class="w-full justify-center bg-yellow-700 hover:bg-yellow-600">
                                Modifier
                            </x-primary-button>
                        </a> --}}
                    
                </div>




                <div class="card  mt-[-50px] p-5 mx-4 mb-6 ">

                    <div class="border-b border-gray-200 pb-4 mb-6">
                        <h2 class="text-xl font-semibold text-gray-800">
                            Informations du paiement
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <p class="text-lg text-gray-500">Nombre de mois</p>
                            <p class="mt-1 font-medium text-gray-800">
                                {{ $facture->nb_mois }}
                            </p>
                        </div>

                        <div>
                            <p class="text-lg text-gray-500">date debut</p>
                            <p class="mt-1 font-medium text-gray-800">
                                {{ $facture->date_debut }}
                            </p>
                        </div>

                        <div>
                            <p class="text-lg text-gray-500">Date fin</p>
                            <p class="mt-1 font-medium text-gray-800">
                                {{ $facture->date_fin }}
                            </p>
                        </div>


                        <div>
                            <p class="text-lg text-gray-500">Les mois</p>
                            <p class="mt-1 font-medium text-gray-800">
                                {{-- @forelse (($facture->les_mois)  as $mois) --}}
                                    {{ implode(', ', $facture->les_mois) }}
                                {{-- @empty
                                    <p>Acun mois</p>
                                @endforelse --}}
                            </p>
                        </div>

                        <div>
                            <p class="text-lg text-gray-500">Monatnt</p>
                            <p class="mt-1 font-medium text-gray-800">
                                {{ $facture->montant }}
                            </p>
                        </div>

                        <div>
                            <p class="text-lg text-gray-500">Abonnee</p>
                            <p class="mt-1 font-medium text-gray-800">
                               
                                {{ $facture->abonnement->menage->designation }}
                                

                            </p>
                        </div>

                         <div>
                            <p class="text-lg text-gray-500">Methode Paiement</p>
                            <p class="mt-1 font-medium text-gray-800">
                               
                                {{ $facture->methodePaiement->type }}
                                

                            </p>
                        </div>


                    </div>
                </div>



            </div>

        </div>
    


    </x-slot>

</x-app-layout>
