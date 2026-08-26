<x-app-layout>
    <x-slot>

        <div class="w-full p-2 flex justify-center items-center ">

            <div class="w-full m-2">
                <div class="flex justify-between items-baseline  mt-6 mb-6">
                    <div class="flex justify-between  items-baseline ">
                        <h1 class="text-blue-700 font-medium text-2xl max-sm:pl-2 max-sm:text-xl">Liste des abonnements
                        </h1>
                    </div>

                    <div class="flex items-center justify-end  max-sm:pr-8 mt-6 w-60 max-sm:w-full max-sm:w-30">
                        <a href="{{ route('abonnements.create') }}">
                            <x-primary-button class="w-full justify-center max-sm:py-2 max-sm:text-sm">
                                {{ __('Ajouter') }}
                            </x-primary-button>
                        </a>
                    </div>
                </div>

                <div class="relative overflow-x-auto card shadow">
                    <table class="text-left w-full whitespace-nowrap">
                        <thead class="">
                            <tr class="border-gray-300 border-b ">
                                <th scope="col" class="px-6 py-3">Code</th>
                                <th scope="col" class="px-6 py-3">Menage</th>
                                <th scope="col" class="px-6 py-3">Responsable</th>
                                <th scope="col" class="px-6 py-3">Etat</th>
                                <th scope="col" class="px-6 py-3">En Regle</th>
                                <th scope="col" class="px-6 py-3">Date Debut</th>
                                <th scope="col" class="px-6 py-3">Date Fin</th>
                                <th scope="col" class="px-6 py-3 flex justify-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y ">
                            @forelse($abonnements as $abonnement)
                            <tr class="border-gray-300 border-b hover:bg-gray-100 "></tr>

                            <td class="py-3 px-6 text-left">{{ $abonnement->menage->code }}</td>
                            <td class="py-3 px-6 text-left">{{ $abonnement->menage->designation }}</td>
                            <td class="py-3 px-6 text-left">{{ $abonnement->menage->client->user->nom }}</td>

                            @if ($abonnement->etat=="ACTIF")
                            <td class="py-3 px-6 text-left">
                                <span
                                    class="bg-green-200 px-2 py-1 text-green-900 text-sm font-medium rounded-md inline-block whitespace-nowrap text-center">{{
                                    $abonnement->etat }}</span>
                            </td>
                            @else
                            <td class="py-3 px-6 text-left">
                                <span class="bg-red-200 px-2 py-1 text-red-600 text-sm
                                          font-medium rounded-md inline-block whitespace-nowrap text-center">{{
                                    $abonnement->etat }}</span>
                            </td>
                            @endif

                            @if ($abonnement->menage->est_en_regle==1)
                            <td class="py-3 px-6 text-left">
                                <span
                                    class="bg-green-200 px-2 py-1 text-green-900 text-sm font-medium rounded-md inline-block whitespace-nowrap text-center">Oui</span>
                            </td>
                            @else
                            <td class="py-3 px-6 text-left">
                                <span class="bg-red-200 px-2 py-1 text-red-600 text-sm
                                          font-medium rounded-md inline-block whitespace-nowrap text-center">Non</span>
                            </td>
                            @endif


                            <td class="py-3 px-6 text-left">{{ $abonnement->date_debut }}</td>

                            @if ($abonnement->date_fin)
                            <td class="py-3 px-6 text-left">{{ $abonnement->date_fin }}</td>
                            @else
                            <td class="py-3 px-6 text-left">---</td>
                            @endif

                            <td class="py-3 px-6 text-left flex justify-end gap-2">


                                <a href="{{ route('abonnements.show', $abonnement->id) }}">
                                    <x-secondary-button
                                        class="bg-blue-700 text-white border-blue-700 hover:bg-blue-600 hover:border-blue-600 focus:ring-blue-700">
                                        Show
                                    </x-secondary-button>
                                </a>


                                <a href="{{ route('abonnements.edit', $abonnement->id) }}">
                                    <x-secondary-button
                                        class="bg-yellow-700 text-white border-yellow-700 hover:bg-yellow-600 hover:border-yellow-600 focus:ring-yellow-300">
                                        Modifier
                                    </x-secondary-button>
                                </a>


                                <form action="{{ route('abonnements.annuler', $abonnement->id) }}" method="post">
                                    @csrf

                                    <x-secondary-button type="submit"
                                        class="bg-fuchsia-700 text-white border-fuchsia-700 hover:bg-fuchsia-600 hover:border-fuchsia-600 focus:ring-fuchsia-700">
                                        Annuler
                                    </x-secondary-button>
                                </form>


                                <form action="{{ route('abonnements.valider', $abonnement->id) }}" method="post">
                                    @csrf

                                    <x-secondary-button type="submit"
                                        class="bg-green-700 text-white border-green-700 hover:bg-green-600 hover:border-green-600 focus:ring-green-300">
                                        Valider
                                    </x-secondary-button>
                                </form>


                                <form action="{{ route('abonnements.desabonnee', $abonnement->id) }}" method="post">
                                    @csrf

                                    <x-secondary-button type="submit"
                                        class="bg-red-700 text-white border-red-700 hover:bg-red-600 hover:border-red-600 focus:ring-red-300">
                                        Désabonner
                                    </x-secondary-button>
                                </form>


                                <form action="{{ route('abonnements.radier', $abonnement->id) }}" method="post">
                                    @csrf

                                    <x-secondary-button type="submit"
                                        class="bg-teal-700 text-white border-teal-700 hover:bg-teal-600 hover:border-teal-600 focus:ring-teal-300">
                                        Radier
                                    </x-secondary-button>
                                </form>

                            </td>

                            </tr>
                            @empty
                            <tr class="flex justify-center items-center">
                                <td colspan="5" class="py-3 px-6 text-left">Aucun Abonnement</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>