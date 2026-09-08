<x-app-layout>

    <x-slot>
        <div class="w-full flex justify-center items-center ">

            <div class="w-full ">
                <div class="h-40 w-full max-sm:h-48 bg-indigo-600 py-2 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-baseline">
                    <div class="flex justify-between  items-baseline max-sm:w-full max-sm:flex-col max-sm:gap-2">
                        <h1 class="text-white font-medium text-2xl max-sm:pl-2 max-sm:text-xl max-sm:w-72">
                            Détails d'un Tournee dans la zone :
                            <span class="capitalize">{{$tournee->zone->designation}}</span>
                        </h1>
                    </div>

                    <div class="flex items-end justify-end gap-2 max-sm:flex-col max-sm:gap-2 max-sm:w-full">
                        @can('tournee.voire')
                        <a href="{{ route('tournees.index') }}" class="">
                            <x-secondary-button
                                class="bg-white text-black py-3 hover:bg-slate-50 justify-center max-sm:py-2 max-sm:text-md ">
                                {{ __('Listes') }}
                            </x-secondary-button>
                        </a>
                        @endcan

                        @if ($tournee->status=="PREVU" )
                        @can('tournee.modifier')
                        <a href="{{ route('tournees.edit', $tournee->id) }}" class="">
                            <x-secondary-button
                                class="bg-yellow-500 text-black py-3  hover:bg-yellow-400  justify-center max-sm:py-2 max-sm:text-md ">
                                {{ __('Modifier') }}
                            </x-secondary-button>
                        </a>
                        @endcan
                        @endif

                    </div>

                </div>

                <div class="card mx-4  mt-[-50px] p-5 mb-6 gap-2">
                    <!-- info abonnee -->
                    <div>

                        <div class="border-b border-gray-200 pb-4 mb-6 flex justify-between ">
                            <h2 class="text-xl font-semibold text-gray-800">
                                Informations de la Tournee
                            </h2>

                            <div class="py-3 px-6 text-left">
                                @if ( $tournee->status=="TERMINEE")

                                <span
                                    class="bg-green-200 px-2 py-1 text-green-900 text-sm font-medium rounded-md inline-block whitespace-nowrap text-center">{{
                                    $tournee->status }}</span>

                                @elseif ( $tournee->status=="EN_COUR")

                                <span class="bg-yellow-200 px-2 py-1 text-yellow-600 text-sm
                                          font-medium rounded-md inline-block whitespace-nowrap text-center">{{
                                    $tournee->status }}</span>

                                @elseif ( $tournee->status=="PREVU")

                                <span class="bg-blue-200 px-2 py-1 text-blue-600 text-sm
                                          font-medium rounded-md inline-block whitespace-nowrap text-center">{{
                                    $tournee->status }}</span>

                                @endif
                            </div>

                            <div class="flex justify-start items-center gap-2 mt-4 max-sm:flex-col max-sm:gap-2">
                                @if ($tournee->status=="PREVU" )

                                @can('tournee.demarer')
                                <form action="{{ route('tournees.demarer', $tournee->id) }}" method="post">
                                    @csrf
                                    <x-secondary-button type="submit"
                                        class="bg-teal-700 text-white border-teal-700 hover:bg-teal-600 hover:border-teal-600 focus:ring-teal-300">
                                        Demarer
                                    </x-secondary-button>
                                </form>
                                @endcan

                                @can('tournee.annuler')
                                <form action="{{ route('tournees.annuler', $tournee->id) }}" method="post">
                                    @csrf
                                    <x-secondary-button type="submit"
                                        class="bg-red-700 text-white border-red-700 hover:bg-red-600 hover:border-red-600 focus:ring-red-300">
                                        Annuler
                                    </x-secondary-button>
                                </form>
                                @endcan
                                @elseif($tournee->status=="EN_COUR")

                                @can('tournee.terminer')
                                <form action="{{ route('tournees.terminer', $tournee->id) }}" method="post">
                                    @csrf
                                    <x-secondary-button type="submit"
                                        class="bg-green-700 text-white border-green-700 hover:bg-green-600 hover:border-green-600 focus:ring-green-300">
                                        Terminer
                                    </x-secondary-button>
                                </form>
                                @endcan
                                @endif
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                            <div>
                                <p class="text-lg text-gray-500">Nombre de ménage</p>
                                <p class="mt-1 font-medium text-gray-800">
                                    {{ $tournee->nbr_menage() }}
                                </p>
                            </div>

                            <div>
                                <p class="text-lg text-gray-500">Nombre D'employer</p>
                                <p class="mt-1 font-medium text-gray-800">
                                    {{ $tournee->nbr_employe() }}
                                </p>
                            </div>

                            <div>
                                <p class="text-lg text-gray-500">Date de Tournée</p>
                                <p class="mt-1 font-medium text-gray-800">
                                    {{ $tournee->date }}
                                </p>
                            </div>

                             <div>
                                <p class="text-lg text-gray-500">Les employés</p>

                                @foreach( $employes as $employe)
                                <p class="mt-1 font-medium text-gray-800">
                                   {{ $employe->user->nom }} ( {{ $employe->user->contacte }})
                                </p>
                               @endforeach
                            </div>


                        </div>

                    </div>


                    <div class="m-4">
                        {{$ligne_tournees->links()}}
                    </div>

                </div>

                <div class="relative overflow-x-auto card shadow mx-4">
                    <table class="text-left w-full whitespace-nowrap">
                        <thead class="">
                            <tr class="border-gray-300 border-b ">
                                <th scope="col" class="px-6 py-3">Code</th>
                                <th scope="col" class="px-6 py-3">Menage</th>
                                <th scope="col" class="px-6 py-3">Quartier</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Longitude</th>
                                <th scope="col" class="px-6 py-3">Latitude</th>
                                <th scope="col" class="px-6 py-3 flex justify-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y ">
                            @forelse($ligne_tournees as $ligne)
                            <tr class="border-gray-300 border-b hover:bg-gray-100 ">

                                <td class="py-3 px-6 text-left">{{ $tournee->code }}</td>
                                <td class="py-3 px-6 text-left">{{ $ligne->menage->designation }}</td>
                                <td class="py-3 px-6 text-left">{{ $ligne->menage->quartier->designation }}</td>

                                <td class="py-3 px-6 text-left">
                                    @if ( $ligne->status=="VIDER")
                                    <span
                                        class="bg-green-200 px-2 py-1 text-green-900 text-sm font-medium rounded-md inline-block whitespace-nowrap text-center">{{
                                        $ligne->status }}</span>
                                </td>
                                @else
                                <span class="bg-yellow-200 px-2 py-1 text-yellow-600 text-sm
                                          font-medium rounded-md inline-block whitespace-nowrap text-center">{{
                                    $ligne->status }}</span>
                                @endif
                                </td>

                                <td class="py-3 px-6 text-left">{{ $ligne->menage->longitude }}</td>
                                <td class="py-3 px-6 text-left">{{ $ligne->menage->latitude }}</td>


                                <td class="py-3 px-6 text-left flex  items-center gap-2">

                                    @if ($tournee->status=="EN_COUR")
                                    @can('ligne_tournee.terminer')
                                    <form action="{{ route('ligne_tournee.terminer', $ligne->id) }}" method="post">
                                        @csrf
                                        <x-secondary-button type="submit"
                                            class="bg-green-700 text-white border-green-700 hover:bg-green-600 hover:border-green-600 focus:ring-green-300">
                                            VIDER
                                        </x-secondary-button>
                                    </form>
                                    @endcan
                                    @endif

                                </td>

                            </tr>
                            @empty
                            <tr class=" flex justify-center items-center">
                                <td class=" flex items-center justify-center py-3 px-6 text-center">Aucun tournee
                                </td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
    </x-slot>
</x-app-layout>