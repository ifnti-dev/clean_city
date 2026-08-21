<x-app-layout> 

    <x-slot>
        <div class="flex items-center justify-between mt-6 w-full">
            <h1 class="text-xl">Liste des clients<h1>
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
                      
                            <tr class="border-gray-300 border-b hover:bg-gray-100 ">
                                <td class="py-3 px-6 text-left">{{ $client->id }}</td>
                                <td class="py-3 px-6 text-left">{{ $client->user->nom }}</td>
                                <td class="py-3 px-6 text-left">{{ $client->user->prenom }}</td>
                                <td class="py-3 px-6 text-left">{{ $client->user->contacte }}</td>
                                <td class="py-3 px-6 text-left">{{ $client->user->email }}</td>    
                            </tr>
                        
                        
                    </tbody>
                </table>
            </div>

            <div class="pt-10 pb-80 pl-5">
                <x-primary-button class="">
                    <a href="{{ route('clients.index') }}"> 
                        Revenire
                    </a>
                </x-primary-button>

            </div>
        </body>
    </x-slot>

</x-app-layout>

