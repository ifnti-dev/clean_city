<x-app-layout> 

    <x-slot>
        <div class="flex items-center justify-between mt-6 w-full">
            <h1 class="text-xl">Liste des clients<h1>
            <x-primary-button class="">
                <a href="{{ route('clients.create') }}"> 
                    Ajouter un client
                </a>
            </x-primary-button>
        </div>


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
                            <th scope="col" class="px-6 py-3">Action</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y ">
                        @forelse ($clients as $client)
                            <tr class="border-gray-300 border-b hover:bg-gray-100 ">
                                <td class="py-3 px-6 text-left">{{ $client->id }}</td>
                                <td class="py-3 px-6 text-left">{{ $client->user->nom }}</td>
                                <td class="py-3 px-6 text-left">{{ $client->user->prenom }}</td>
                                <td class="py-3 px-6 text-left">{{ $client->user->contacte }}</td>
                                <td class="py-3 px-6 text-left">{{ $client->user->email }}</td>
                                <td class="py-3 px-6 text-left">

                                <td class="flex gap-6 px-3 py-3 flex"> 
                                    
                                    <a href="{{ route('clients.show', $client->id) }}"> <button class="primary-button"> Voire </button> </a>
                                
                                    <a href="{{ route('clients.edit', $client->id) }}"> 
                                        
                                        Editer
                                    </a>
                                </td>
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
    </x-slot>

</x-app-layout>

