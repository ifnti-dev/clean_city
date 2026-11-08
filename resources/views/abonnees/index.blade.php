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

                    <form method="GET" action="{{ route('abonnements.index') }}" class="search-filter">

                        <div class="search-filter-fields">

                            {{-- recherche --}}
                            <div class="lg:col-span-2">
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">
                                    Recherche
                                </label>

                                <input type="search" name="search" id="search" value="{{ request('search') }}"
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
                        <div class="search-filter-actions">

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
                                <th scope="col" class="px-6 py-3">Date Debut</th>
                                <th scope="col" class="px-6 py-3">Date Fin</th>
                                <th scope="col" class="px-6 py-3">Etat</th>
                                <th scope="col" class="px-6 py-3">En Regle</th>
                                <th scope="col" class="px-6 py-3 flex justify-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y ">
                            @forelse($abonnements as $abonnement)
                            <tr class="border-gray-300 border-b hover:bg-gray-100 ">

                            <td class="py-3 px-6 text-left">{{ $abonnement->menage->code ?? '-' }}</td>
                            <td class="py-3 px-6 text-left">{{ $abonnement->menage->designation ?? '-' }}</td>
                            <td class="py-3 px-6 text-left">{{ $abonnement->menage->client->user->nom ?? '-' }}</td>


                            @if ($abonnement->date_debut)
                            <td class="py-3 px-6 text-left">{{ $abonnement->date_debut }}</td>
                            @else
                            <td class="py-3 px-6 text-left">---</td>
                            @endif


                            @if ($abonnement->date_fin)
                            <td class="py-3 px-6 text-left">{{ $abonnement->date_fin }}</td>
                            @else
                            <td class="py-3 px-6 text-left">---</td>
                            @endif

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

                            <td class="px-6 py-3 text-right align-middle">
                            <td class="px-6 py-3 text-right align-middle">
                                <x-action-menu :id="'abonnement-actions-' . $abonnement->id">
                                @if ($abonnement->status=="APPROUVER")
                                <form action="{{route('abonnements.piece_justificatif',$abonnement->id)}}"
                                    method="post">
                                    @csrf
                                    <button type="submit" class="action-menu-item">Télécharger la pièce</button>
                                </form>
                                @endif


                                @can('abonnement.voire')
                                <a href="{{ route('abonnements.show', $abonnement->id) }}">
                                    <span class="action-menu-item">Voir</span>
                                </a>
                                @endcan

                                @can('abonnement.modifier')
                                <a href="{{ route('abonnements.edit', $abonnement->id) }}">
                                    <span class="action-menu-item">Modifier</span>
                                </a>
                                @endcan

                                </x-action-menu>
                               
                            </td>

                            </tr>
                            @empty
                            <tr class="flex justify-center items-center">
                                <td colspan="8" class="py-3 px-6 text-left">Aucun Abonnement</td>
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