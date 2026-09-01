<x-app-layout>

    <x-slot>

        <div class="w-full p-2 flex justify-center items-center">

            <div class="w-full m-2">

                <div class="flex justify-between items-baseline mt-6 mb-6">

                    <div class="flex justify-between items-baseline">

                        <h1 class="text-blue-700 font-medium text-2xl max-sm:pl-2 max-sm:text-xl">
                            Liste des employés
                        </h1>

                    </div>

                    <div class="flex items-center justify-end max-sm:pr-8 mt-6 w-60 max-sm:w-full">

                        <a href="{{ route('employes.create') }}">

                            <x-primary-button class="w-full justify-center max-sm:py-2 max-sm:text-sm">
                                {{ __('Ajouter') }}
                            </x-primary-button>

                        </a>

                    </div>

                </div>

                <div class="card shadow mb-6 p-5">

                    <form method="GET" action="{{ route('employes.index') }}">

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                            <div class="lg:col-span-2">

                                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">
                                    Recherche
                                </label>

                                <input type="text" name="search" id="search" value="{{ request('search') }}"
                                    placeholder="Nom, prénom, email ou contact..."
                                    class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                            </div>

                            <div>

                                <label for="role" class="block text-sm font-medium text-gray-700 mb-1">
                                    Rôle
                                </label>

                                <select name="role" id="role"
                                    class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                                    <option value="">
                                        Tous
                                    </option>

                                    @foreach ($roles as $role)

                                    <option value="{{ $role->name }}" {{ request('role')==$role->name ? 'selected' : ''
                                        }}
                                        >
                                        {{ $role->name }}
                                    </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                        <div class="flex justify-end gap-3 mt-5">

                            <a href="{{ route('employes.index') }}">

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

                <div class="relative overflow-x-auto card shadow">

                    <table class="text-left w-full whitespace-nowrap">

                        <thead>

                            <tr class="border-gray-300 border-b">

                                <th scope="col" class="px-6 py-3">
                                    Nom
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Prénom
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Contact
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Email
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Rôle
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>

                            </tr>

                        </thead>

                        <tbody class="divide-y">

                            @forelse ($employes as $employe)

                            <tr class="border-gray-300 border-b hover:bg-gray-100">

                                <td class="py-3 px-6">
                                    {{ $employe->user->nom }}
                                </td>

                                <td class="py-3 px-6">
                                    {{ $employe->user->prenom }}
                                </td>

                                <td class="py-3 px-6">
                                    {{ $employe->user->contacte }}
                                </td>

                                <td class="py-3 px-6">
                                    {{ $employe->user->email }}
                                </td>

                                <td class="py-3 px-6">

                                    @foreach ($employe->user->roles as $role)

                                    <span class="bg-blue-200 px-2 py-1 text-blue-900 text-sm font-medium rounded-md">
                                        {{ $role->name }}
                                    </span>

                                    @endforeach

                                </td>

                                <td class="py-3 px-6 flex items-center gap-2">

                                    <a href="{{ route('employes.show', $employe->id) }}">
                                        <x-secondary-button
                                            class="bg-blue-700 text-white border-blue-700 hover:bg-blue-600">
                                            Voir
                                        </x-secondary-button>
                                    </a>

                                    <a href="{{ route('employes.edit', $employe->id) }}">
                                        <x-secondary-button
                                            class="bg-yellow-700 text-white border-yellow-700 hover:bg-yellow-600">
                                            Modifier
                                        </x-secondary-button>
                                    </a>
<!-- 
                                    <form method="POST" action="{{ route('employes.destroy', $employe->id) }}"
                                        onsubmit="return confirm('Voulez-vous vraiment supprimer cet employé ?')">
                                        @csrf
                                        @method('DELETE')

                                        <x-secondary-button type="submit"
                                            class="bg-red-700 text-white border-red-700 hover:bg-red-600">
                                            Supprimer
                                        </x-secondary-button>
                                    </form> -->

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="6" class="py-3 px-6 text-center">
                                    Aucun employé
                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="m-4">
                    {{$employes->links()}}
                </div>

            </div>

        </div>

    </x-slot>

</x-app-layout>