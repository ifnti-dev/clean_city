<x-app-layout>
    <div>
        <div class="mb-6 flex min-h-32 items-center bg-indigo-600 px-6 py-8 lg:px-8">
            <div>
                <h1 class="text-2xl font-semibold text-white">Statistiques</h1>
                <p class="mt-1 text-sm text-indigo-100">Répartition des ménages et des abonnés par type d'habitat.</p>
            </div>
        </div>

        <div class="-mt-2 mx-6 mb-6 grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-4">
            <article class="card shadow">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total des ménages</p>
                            <p class="mt-2 text-3xl font-bold text-gray-800">{{ number_format($total_menages, 0, ',', ' ') }}</p>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-md bg-indigo-600 bg-opacity-10 text-indigo-600">
                            <i data-feather="home" class="h-5 w-5"></i>
                        </div>
                    </div>
                </div>
            </article>

            <article class="card shadow">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Abonnés actifs</p>
                            <p class="mt-2 text-3xl font-bold text-gray-800">{{ number_format($total_abonnes_actifs, 0, ',', ' ') }}</p>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-md bg-indigo-600 bg-opacity-10 text-indigo-600">
                            <i data-feather="users" class="h-5 w-5"></i>
                        </div>
                    </div>
                </div>
            </article>

            <article class="card shadow">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Ménages désabonnés</p>
                            <p class="mt-2 text-3xl font-bold text-gray-800">{{ number_format($total_desabonnes, 0, ',', ' ') }}</p>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-md bg-indigo-600 bg-opacity-10 text-indigo-600">
                            <i data-feather="user-minus" class="h-5 w-5"></i>
                        </div>
                    </div>
                </div>
            </article>

            <article class="card shadow">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Abonnés radiés</p>
                            <p class="mt-2 text-3xl font-bold text-gray-800">{{ number_format($total_abonnes_radies, 0, ',', ' ') }}</p>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-md bg-indigo-600 bg-opacity-10 text-indigo-600">
                            <i data-feather="user-x" class="h-5 w-5"></i>
                        </div>
                    </div>
                </div>
            </article>
        </div>

        <div class="mx-6 mb-6 grid grid-cols-1 gap-6 xl:grid-cols-2">
            <section class="card shadow">
                <div class="border-b border-gray-300 px-5 py-4">
                    <h2 class="font-semibold text-gray-800">Répartition par type d'habitat</h2>
                    <p class="mt-1 text-sm text-gray-500">Effectif et part de chaque type dans l'ensemble des ménages.</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full whitespace-nowrap text-left">
                        <thead class="text-gray-700">
                            <tr>
                                <th scope="col" class="border-b bg-gray-100 px-4 py-3">Type d'habitat</th>
                                <th scope="col" class="border-b bg-gray-100 px-4 py-3 text-right">Effectif</th>
                                <th scope="col" class="border-b bg-gray-100 px-4 py-3 text-right">% du total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($repartition as $typeHabitat)
                                <tr class="hover:bg-gray-50">
                                    <td class="border-b border-gray-200 px-4 py-3 font-medium text-gray-700">
                                        {{ $typeHabitat->designation }}
                                    </td>
                                    <td class="border-b border-gray-200 px-4 py-3 text-right text-gray-700">
                                        {{ number_format($typeHabitat->effectif, 0, ',', ' ') }}
                                    </td>
                                    <td class="border-b border-gray-200 px-4 py-3 text-right text-gray-700">
                                        {{ number_format($typeHabitat->pourcentage, 1, ',', '') }}%
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-8 text-center text-gray-500">
                                        Aucun type d'habitat n'est enregistré.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot class="bg-indigo-600 font-semibold text-white">
                            <tr>
                                <th scope="row" class="px-4 py-3">TOTAL</th>
                                <td class="px-4 py-3 text-right">{{ number_format($total_menages, 0, ',', ' ') }}</td>
                                <td class="px-4 py-3 text-right">{{ $pourcentage_total }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </section>

            <section class="card shadow">
                <div class="border-b border-gray-300 px-5 py-4">
                    <h2 class="font-semibold text-gray-800">Abonnés par type d'habitat</h2>
                    <p class="mt-1 text-sm text-gray-500">Nombre de ménages abonnés dans chaque type.</p>
                </div>
                <div class="card-body">
                    @if ($repartition->isEmpty())
                        <p class="py-8 text-center text-gray-500">Aucune donnée à afficher.</p>
                    @else
                        <div class="space-y-5" role="img" aria-label="Graphique du nombre d'abonnés par type d'habitat">
                            @foreach ($repartition as $typeHabitat)
                                <div>
                                    <div class="mb-1 flex items-center justify-between gap-3 text-sm">
                                        <span class="truncate font-medium text-gray-700">{{ $typeHabitat->designation }}</span>
                                        <span class="shrink-0 font-semibold text-gray-800">
                                            {{ number_format($typeHabitat->abonnes, 0, ',', ' ') }}
                                        </span>
                                    </div>
                                    <div class="h-2.5 overflow-hidden rounded-full bg-gray-100">
                                        <div class="h-full rounded-full bg-indigo-600"
                                            style="width: {{ $typeHabitat->largeur_barre }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-6 flex justify-between border-t border-gray-200 pt-3 text-xs text-gray-500">
                            @foreach ($graduations_graphique as $graduation)
                                <span>{{ number_format($graduation, 0, ',', ' ') }}</span>
                            @endforeach
                        </div>
                        <p class="mt-2 text-center text-xs text-gray-500">Effectif des abonnés</p>
                    @endif
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
