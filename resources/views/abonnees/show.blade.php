<x-app-layout>
    <x-slot>

        <div class="w-full flex justify-center items-center ">

            <div class="w-full ">
                <div class="h-40 bg-indigo-600 py-2 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-baseline">
                    <div class="flex justify-between  items-baseline ">
                        <h1 class="text-white font-medium text-2xl max-sm:pl-2 max-sm:text-xl">
                            Détails de l'abonnement : <span
                                class="capitalize">{{$abonnement->menage->designation}}</span>
                        </h1>
                    </div>

                    <div class="flex items-center gap-2 max-sm:w-full">
                        @can('abonnement.voire')
                        <a href="{{ route('abonnements.index') }}" class="w-full">
                            <x-secondary-button
                                class="bg-white text-black py-3  hover:bg-slate-50 w-full justify-center max-sm:py-2 max-sm:text-md ">
                                {{ __('Listes') }}
                            </x-secondary-button>
                        </a>
                        @endcan

                        @can('abonnement.modifier')
                        <a href="{{ route('abonnements.edit', $abonnement->id) }}" class="w-full">
                            <x-secondary-button
                                class="bg-yellow-500 text-black py-3  hover:bg-yellow-400 w-full justify-center max-sm:py-2 max-sm:text-md ">
                                {{ __('Modifier') }}
                            </x-secondary-button>
                        </a>
                        @endcan

                    </div>

                </div>

                <div class="card mx-4  mt-[-50px] p-5 mb-6 gap-2">
                    <!-- info abonnee -->
                    <div>

                        <div class="border-b border-gray-200 pb-4 mb-6">
                            <h2 class="text-xl font-semibold text-gray-800">
                                Informations de l'abonnement
                            </h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                            <div>
                                <p class="text-lg text-gray-500">Code ménage</p>
                                <p class="mt-1 font-medium text-gray-800">
                                    {{ $abonnement->menage->code }}
                                </p>
                            </div>

                            <div>
                                <p class="text-lg text-gray-500">Désignation</p>
                                <p class="mt-1 font-medium text-gray-800">
                                    {{ $abonnement->menage->designation }}
                                </p>
                            </div>

                            <div>
                                <p class="text-lg text-gray-500">Responsable</p>
                                <p class="mt-1 font-medium text-gray-800">
                                    {{ $abonnement->menage->client->user->nom }}
                                </p>
                            </div>

                            <div>
                                <p class="text-lg text-gray-500">Type d'habitat</p>
                                <p class="mt-1 font-medium text-gray-800">
                                    {{ $abonnement->menage->typeHabitat->designation }}
                                </p>
                            </div>

                            <div>
                                <p class="text-lg text-gray-500">Quartier</p>
                                <p class="mt-1 font-medium text-gray-800">
                                    {{ $abonnement->menage->quartier->designation }}
                                </p>
                            </div>



                            <div>
                                <p class="text-lg text-gray-500">Date de début</p>
                                <p class="mt-1 font-medium text-gray-800">
                                    {{ $abonnement->date_debut }}
                                </p>
                            </div>

                            <div>
                                <p class="text-lg text-gray-500">Date de fin</p>
                                <p class="mt-1 font-medium text-gray-800">
                                    {{ $abonnement->date_fin ?? '---' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-lg text-gray-500">État</p>
                                <div class="mt-1">
                                    @if ($abonnement->etat == "ACTIF")
                                    <span class="bg-green-200 px-2 py-1 text-green-900 text-lg font-medium rounded-md">
                                        {{ $abonnement->etat }}
                                    </span>
                                    @else
                                    <span class="bg-red-200 px-2 py-1 text-red-600 text-lg font-medium rounded-md">
                                        {{ $abonnement->etat }}
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div>
                                <p class="text-lg text-gray-500">En règle</p>
                                <div class="mt-1">
                                    @if ($abonnement->menage->est_en_regle == 1)
                                    <span class="bg-green-200 px-2 py-1 text-green-900 text-lg font-medium rounded-md">
                                        Oui
                                    </span>
                                    @else
                                    <span class="bg-red-200 px-2 py-1 text-red-600 text-lg font-medium rounded-md">
                                        Non
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div>
                                <p class="text-lg text-gray-500">Longitude</p>
                                <p class="mt-1 font-medium text-gray-800">
                                    {{ $abonnement->menage->longitude }}
                                </p>
                            </div>

                            <div>
                                <p class="text-lg text-gray-500">Latitude</p>
                                <p class="mt-1 font-medium text-gray-800">
                                    {{ $abonnement->menage->latitude }}
                                </p>
                            </div>

                        </div>
                    </div>

                    <!-- status -->
                    <div class="w-full border-t-2 pt-5 flex justify-baseline items-baseline mt-6">
                        <div class="w-full">
                            <h2 class="text-xl font-semibold mb-4">Statut de l'abonnement</h2>
                            <p class="text-gray-700 mb-4">Le statut actuel de l'abonnement est :
                                <span
                                    class="font-medium px-2 py-1 text-white text-lg rounded-md {{ $abonnement->status == 'EN_ATTENTE' ? 'bg-yellow-500' : ($abonnement->status == 'EN_COUR_DE_TRAITEMENT' ? 'bg-blue-500' : ($abonnement->status == 'APPROUVER' ? 'bg-green-500' : 'bg-red-500')) }}">
                                    {{ $abonnement->status == 'APPROUVER' ? 'APPROUVÉ' : str_replace('_', ' ',
                                    $abonnement->status) }} </span>

                            </p>
                            @php
                            $status=$abonnement->status;
                            @endphp

                        </div>

                        <div class="flex justify-center items-center gap-1 max-md:flex-col max-md:gap-2">
                            @if ($status == 'EN_ATTENTE' )
                            @can('abonnement.traitement')
                            <form action="{{ route('abonnements.traitement', $abonnement->id) }}" method="post">
                                @csrf
                                <x-secondary-button type="submit"
                                    class="bg-blue-700 text-white border-blue-700 hover:bg-blue-600 hover:border-blue-600 focus:ring-blue-300">
                                    Demander le traitement
                                </x-secondary-button>
                            </form>
                            @endcan

                            @elseif ( $status == 'EN_COUR_DE_TRAITEMENT')
                            @can('abonnement.approuver')
                            <form action="{{ route('abonnements.approuver', $abonnement->id) }}" method="post">
                                @csrf
                                <x-secondary-button type="submit"
                                    class="bg-green-700 text-white border-green-700 hover:bg-green-600 hover:border-green-600 focus:ring-green-300">
                                    Approuver
                                </x-secondary-button>
                            </form>
                            @endcan

                            @can('abonnement.rejeter')
                            <form action="{{ route('abonnements.rejeter', $abonnement->id) }}" method="post">
                                @csrf
                                <x-secondary-button type="submit"
                                    class="bg-red-700 text-white border-red-700 hover:bg-red-600 hover:border-red-600 focus:ring-red-300">
                                    Rejeter
                                </x-secondary-button>
                            </form>
                            @endcan
                            @endif

                            @if ($status=="REJETER" )
                            <!-- motif de rejet -->
                            <div>
                                <p class="text-gray-700 mb-4">Motif de rejet :
                                    <span class="font-medium text-red-500">
                                        {{ $abonnement->motif_rejet }} Lorem ipsum dolor, sit amet consectetur
                                        adipisicing elit. Cumque, eius minus! Quod, neque facilis? Illum eveniet in
                                        officiis quia laborum excepturi, minima praesentium repellendus ab dolore
                                        mollitia molestiae similique molestias?
                                    </span>
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>


        </div>


    </x-slot>
</x-app-layout>