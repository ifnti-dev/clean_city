
<x-app-layout> 


    <x-slot>
        <div class="w-full m-2">
                <div class="flex justify-between items-baseline  mt-6 mb-6">
                    <div>
                        <h1>Liste des clients</h1>
                    </div>

                    <div class="flex items-center justify-center mt-6 w-40">
                        <a href="{{ route('clients.create') }}">
                            <x-primary-button class="w-full justify-center">
                                {{ __('Ajouter') }}
                            </x-primary-button>
                        </a>
                    </div>
                </div>

            <body>
                <div class="relative overflow-x-auto">
                    <table class="text-left w-full whitespace-nowrap">
                        <thead class="">
                            <tr class="border-gray-300 border-b ">
                                <th scope="col" class="px-6 py-3">Id</th>
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
                                    <td class=" flex item-center gap-6 px-3 py-3 text-left ">

                                        <a href="{{ route('clients.show', $client->id) }}">  <x-primary-button class="w-full justify-center"> Voire </x-peimary-button> </a>
                                    
                                        <a href="{{ route('clients.edit', $client->id) }}"> 
                                            <x-secondary-button>
                                                Editer
                                            </x-secondary-button>    
                                        </a>

                                        <form action="{{ route('clients.destroy', $client->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')

                                            <x-danger-button> Supprimer </x-danger-button> 
                                        </form>

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
        </div>    
    </x-slot>

</x-app-layout>

