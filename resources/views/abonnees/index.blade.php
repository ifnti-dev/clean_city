@extends('layouts.base')

@section('content')

<div class="p-6">

    {{-- En-tête --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
                Liste des abonnements
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Consultez et gérez les abonnements des clients.
            </p>
        </div>

        <a href="#"
           class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700">
            + Nouvel abonnement
        </a>
    </div>

    {{-- Tableau --}}
    <div class="relative overflow-x-auto bg-white rounded-lg border border-gray-200 shadow-sm">

        <table class="w-full text-sm text-left text-gray-600">

            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-200">
                <tr>
                    <th scope="col" class="px-6 py-4">#</th>
                    <th scope="col" class="px-6 py-4">Client</th>
                    <th scope="col" class="px-6 py-4">Abonnement</th>
                    <th scope="col" class="px-6 py-4">Début</th>
                    <th scope="col" class="px-6 py-4">Expiration</th>
                    <th scope="col" class="px-6 py-4">Statut</th>
                    <th scope="col" class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">

                {{-- Exemple abonnement 1 --}}
                <tr class="hover:bg-gray-50 transition">

                    <td class="px-6 py-4 font-medium text-gray-900">
                        1
                    </td>

                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-900">
                            Abdoulaye Sourouya
                        </div>
                        <div class="text-xs text-gray-500">
                            abdoulaye@example.com
                        </div>
                    </td>

                    <td class="px-6 py-4">
                        <span class="font-medium text-gray-900">
                            Premium
                        </span>
                    </td>

                    <td class="px-6 py-4">
                        20/08/2026
                    </td>

                    <td class="px-6 py-4">
                        20/09/2026
                    </td>

                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                            Actif
                        </span>
                    </td>

                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">

                            <a href="#"
                               class="px-3 py-2 text-xs font-medium text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100">
                                Voir
                            </a>

                            <a href="#"
                               class="px-3 py-2 text-xs font-medium text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">
                                Modifier
                            </a>

                        </div>
                    </td>

                </tr>

                {{-- Exemple abonnement 2 --}}
                <tr class="hover:bg-gray-50 transition">

                    <td class="px-6 py-4 font-medium text-gray-900">
                        2
                    </td>

                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-900">
                            Jean Dupont
                        </div>
                        <div class="text-xs text-gray-500">
                            jean@example.com
                        </div>
                    </td>

                    <td class="px-6 py-4">
                        <span class="font-medium text-gray-900">
                            Standard
                        </span>
                    </td>

                    <td class="px-6 py-4">
                        15/08/2026
                    </td>

                    <td class="px-6 py-4">
                        15/09/2026
                    </td>

                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">
                            En attente
                        </span>
                    </td>

                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">

                            <a href="#"
                               class="px-3 py-2 text-xs font-medium text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100">
                                Voir
                            </a>

                            <a href="#"
                               class="px-3 py-2 text-xs font-medium text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">
                                Modifier
                            </a>

                        </div>
                    </td>

                </tr>

            </tbody>

        </table>
    </div>

</div>

@endsection