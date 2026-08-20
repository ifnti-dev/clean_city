@extends('layouts.base')


@section('content')

<div class="w-full">
    <div class="flex justify-between items-baseline mt-6 mb-6">
        <div>
            <h3>Liste des abonnement</h3>
        </div>

        <div class="flex items-center justify-center mt-6 w-40">
            <a href="{{route('abonnees.create')}}">
                <x-primary-button class="w-full justify-center">
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
                    <th scope="col" class="px-6 py-3">Date Debut</th>
                    <th scope="col" class="px-6 py-3">Date Fin</th>
                    <th scope="col" class="px-6 py-3 flex justify-center">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y ">
                @forelse($abonnements as $abonnement)
                <tr class="border-gray-300 border-b hover:bg-gray-100 "></tr>

                <td class="py-3 px-6 text-left">{{$abonnement->menage->code}}</td>
                <td class="py-3 px-6 text-left">{{$abonnement->menage->designation}}</td>
                <td class="py-3 px-6 text-left">{{$abonnement->menage->client->user->nom}}</td>

                <td class="py-3 px-6 text-left">{{$abonnement->date_debut}}</td>

                @if($abonnement->date_fin)
                <td class="py-3 px-6 text-left">{{$date_fin}}</td>
                @else
                <td class="py-3 px-6 text-left">None</td>
                @endif

                <td class="py-3 px-6 text-left flex justify-end gap-2">

                    <button type="button" class="btn gap-x-2 bg-blue-700 text-white
                                          border-blue-700 disabled:opacity-50 disabled:pointer-events-none
                                          hover:text-white hover:bg-blue-700 hover:border-blue-700 active:bg-blue-700
                                          active:border-blue-700 focus:outline-none focus:ring-4
                                          focus:ring-blue-300">
                        Show
                    </button>
                    <button type="button" class="btn gap-x-2 bg-yellow-600 text-white
                                          border-yellow-600 disabled:opacity-50 disabled:pointer-events-none
                                          hover:text-white hover:bg-yellow-700 hover:border-yellow-700
                                          active:bg-yellow-700 active:border-yellow-700 focus:outline-none focus:ring-4
                                          focus:ring-yellow-300">
                        Update
                    </button>
                    <button type="button" class="btn gap-x-2 bg-red-600 text-white
                                          border-red-600 disabled:opacity-50 disabled:pointer-events-none
                                          hover:text-white hover:bg-red-700 hover:border-red-700 active:bg-red-700
                                          active:border-red-700 focus:outline-none focus:ring-4 focus:ring-red-300">
                        Delete
                    </button>

                    <button type="button" class="btn gap-x-2 bg-teal-600 text-white
                                          border-teal-600 disabled:opacity-50 disabled:pointer-events-none
                                          hover:text-white hover:bg-teal-700 hover:border-teal-700 active:bg-teal-700
                                          active:border-teal-700 focus:outline-none focus:ring-4
                                          focus:ring-teal-300">
                        Radier
                    </button>

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
@endsection