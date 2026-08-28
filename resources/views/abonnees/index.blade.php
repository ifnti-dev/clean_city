<x-app-layout>
    <x-slot>

        <div class="w-full flex justify-center items-center ">

            <div class="w-full ">
                <div class="h-40 bg-indigo-600 py-2 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-baseline">
                    <div class="flex justify-between  items-baseline ">
                        <h1 class="text-white font-medium text-2xl max-sm:pl-2 max-sm:text-xl">Liste des abonnements
                        </h1>
                    </div>

                    <div class=" flex items-center justify-end  max-sm:pr-8 mb-14  w-60 max-sm:w-full max-sm:w-30">
                        <a href="{{ route('abonnements.create') }}">
                            <x-secondary-button
                                class="bg-white text-black py-3  hover:bg-slate-50 w-full justify-center max-sm:py-2 max-sm:text-md ">
                                {{ __('Ajouter') }}
                            </x-secondary-button>
                        </a>
                    </div>
                </div>

                {{--filtre --}}
                <!-- <div class="card shadow mb-6 p-5"> -->
                <div class=" card  mt-[-50px] p-5 mx-4 mb-6 ">

                    <form method="GET" action="{{ route('abonnements.index') }}">

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">

                            {{-- recherche --}}
                            <div class="lg:col-span-2">
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">
                                    Recherche
                                </label>

                                <input type="text" name="search" id="search" value="{{ request('search') }}"
                                    placeholder="Code, ménage ou responsable..."
                                    class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>


                            <div>
                                <label for="etat" class="block text-sm font-medium text-gray-700 mb-1">
                                    État
                                </label>

                                <select name="etat" id="etat"
                                    class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Tous</option>

                                    <option value="ACTIF" {{ request('etat')==='ACTIF' ? 'selected' : '' }}>
                                        Actif
                                    </option>

                                    <option value="INACTIF" {{ request('etat')==='INACTIF' ? 'selected' : '' }}>
                                        Inactif
                                    </option>
                                </select>
                            </div>

                            {{-- en regle --}}
                            <div>
                                <label for="en_regle" class="block text-sm font-medium text-gray-700 mb-1">
                                    En règle
                                </label>

                                <select name="en_regle" id="en_regle"
                                    class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Tous</option>

                                    <option value="1" {{ request('en_regle')==='1' ? 'selected' : '' }}>
                                        Oui
                                    </option>

                                    <option value="0" {{ request('en_regle')==='0' ? 'selected' : '' }}>
                                        Non
                                    </option>
                                </select>
                            </div>

                            {{-- Date debut --}}
                            <div>
                                <label for="date_debut" class="block text-sm font-medium text-gray-700 mb-1">
                                    Date début
                                </label>

                                <input type="date" name="date_debut" id="date_debut" value="{{ request('date_debut') }}"
                                    class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            {{-- Date fin --}}
                            <div>
                                <label for="date_fin" class="block text-sm font-medium text-gray-700 mb-1">
                                    Date fin
                                </label>

                                <input type="date" name="date_fin" id="date_fin" value="{{ request('date_fin') }}"
                                    class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>

                        </div>

                        {{-- Boutons --}}
                        <div class="flex justify-end gap-3 mt-5">

                            <a href="{{ route('abonnements.index') }}">
                                <x-secondary-button type="button"
                                    class="bg-gray-100 text-gray-700 border-gray-300 hover:bg-gray-200">
                                    Réinitialiser
                                </x-secondary-button>
                            </a>

                            <x-primary-button type="submit">
                                Filtrer
                            </x-primary-button>

                        </div>

                    </form>

                </div>

                <div class="relative mx-4 overflow-x-auto card shadow">
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

                            <td class="py-3 px-6 text-left flex  items-center gap-2">


                                <a href="{{ route('abonnements.show', $abonnement->id) }}">
                                    <x-secondary-button
                                        class="bg-blue-700 text-white border-blue-700 hover:bg-blue-600 hover:border-blue-600 focus:ring-blue-700">
                                        Voir
                                    </x-secondary-button>
                                </a>


                                <a href="{{ route('abonnements.edit', $abonnement->id) }}">
                                    <x-secondary-button
                                        class="bg-yellow-700 text-white border-yellow-700 hover:bg-yellow-600 hover:border-yellow-600 focus:ring-yellow-300">
                                        Modifier
                                    </x-secondary-button>
                                </a>


                                <!-- <form action="{{ route('abonnements.annuler', $abonnement->id) }}" method="post">
                                    @csrf

                                    <x-secondary-button type="submit"
                                        class="bg-fuchsia-700 text-white border-fuchsia-700 hover:bg-fuchsia-600 hover:border-fuchsia-600 focus:ring-fuchsia-700">
                                        Annuler
                                    </x-secondary-button>
                                </form> -->

                                @if ($abonnement->menage->est_en_regle==0 || $abonnement->etat=="ACTIF" )



                                @else

                                @endif


                                @if ($abonnement->etat=="INACTIF" )
                                <form action="{{ route('abonnements.valider', $abonnement->id) }}" method="post">
                                    @csrf

                                    <x-secondary-button type="submit"
                                        class="bg-green-700 text-white border-green-700 hover:bg-green-600 hover:border-green-600 focus:ring-green-300">
                                        Valider
                                    </x-secondary-button>
                                </form>

                                <form action="{{ route('abonnements.radier', $abonnement->id) }}" method="post">
                                    @csrf

                                    <x-secondary-button type="submit"
                                        class="bg-teal-700 text-white border-teal-700 hover:bg-teal-600 hover:border-teal-600 focus:ring-teal-300">
                                        Radier
                                    </x-secondary-button>
                                </form>

                                @elseif($abonnement->menage->est_en_regle==0 && $abonnement->etat=="ACTIF" )

                                <form action="{{ route('abonnements.desabonnee', $abonnement->id) }}" method="post">
                                    @csrf

                                    <x-secondary-button type="submit"
                                        class="bg-red-700 text-white border-red-700 hover:bg-red-600 hover:border-red-600 focus:ring-red-300">
                                        Désabonner
                                    </x-secondary-button>
                                </form>
                                @endif

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
                <div class="m-4">
                    {{$abonnements->links()}}
                </div>
            </div>

        </div>
    </x-slot>
</x-app-layout>