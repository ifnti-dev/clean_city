@extends('layouts.base')

@section('content')
    <body>
        <div class="relative overflow-x-auto">
            <table class="text-left w-full whitespace-nowrap">
                <thead class="">
                    <tr class="border-gray-300 border-b ">
                        <th scope="col" class="px-6 py-3">id</th>
                        <th scope="col" class="px-6 py-3">Nom</th>
                        <th scope="col" class="px-6 py-3">Prenom</th>
                        <th scope="col" class="px-6 py-3">Contacte</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                    </tr>
                </thead>

                <tbody class="divide-y ">
                    @forelse ($clients as $client)
                        <tr class="border-gray-300 border-b hover:bg-gray-100 ">
                            <td class="py-3 px-6 text-left">{{ $client->user_id }}</td>
                            <td class="py-3 px-6 text-left">{{ $client->user->nom }}</td>
                            <td class="py-3 px-6 text-left">{{ $client->user->prenom }}</td>
                            <td class="py-3 px-6 text-left">{{ $client->user->contacte }}</td>
                            <td class="py-3 px-6 text-left">{{ $client->user->email }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6"> Aucun client </td>
                        </tr>
                    @endforelse
                    
                </tbody>
            </table>
        </div>

    </body>
@endsection


