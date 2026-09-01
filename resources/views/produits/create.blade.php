<x-app-layout>

    <x-slot>

         <div class="w-full ">
                <div class="h-40 bg-indigo-600 py-2 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-baseline">
                    <div class="flex justify-between  items-baseline ">
                        <h1 class="text-white font-medium text-2xl max-sm:pl-2 max-sm:text-xl">Ajouter un produit
                        </h1>
                    </div>

                    <div class=" flex items-center justify-end  max-sm:pr-8 mb-14  w-60 max-sm:w-full max-sm:w-30">
                        <a href="{{ route('produits.create') }}">
                            <x-secondary-button
                                class="bg-white text-black py-3  hover:bg-slate-50 w-full justify-center max-sm:py-2 max-sm:text-md ">
                                {{ __('Ajouter') }}
                            </x-secondary-button>
                        </a>
                    </div>
        </div>


        

        <div class=" card  mt-[-50px] p-5 mx-4 mb-6 ">
            <form method="POST" action="{{ route('produits.store') }}" >
            @csrf
            <div class="flex gap-5 justify-between">
                 <!-- label -->
                <div class="mt-4 w-full">
                    <x-input-label for="nom" :value="__('label')" />

                    <x-text-input
                        id="label"
                        class="block mt-1 w-full"
                        type="text"
                        name="label"
                        :value="old('label')"
                        required
                        autofocus
                        placeholder="label"
                        autocomplete="family-name"
                    />

                    <x-input-error
                        :messages="$errors->get('label')"
                        class="mt-2"
                    />
                </div>

            <!-- Prix unitaire -->
                <div class="mt-4 w-full">
                    <x-input-label for="prix_unitaire" :value="__('Prix Unitaire')" />

                    <x-text-input
                        id="prix_unitaire"
                        class="block mt-1 w-full"
                        type="text"
                        name="prix_unitaire"
                        :value="old('prenom')"
                        required
                        placeholder="prix_unitaire"
                        autocomplete="given-name"
                    />

                    <x-input-error
                        :messages="$errors->get('prix_unitaire')"
                        class="mt-2"
                    />
                </div>
            </div>
           
            <div class="flex gap-5 justify-between">
                <!-- Description -->
                <div class="mt-4 w-full">
                    <x-input-label for="description" :value="__('description')" />

                    <x-text-input
                        id="description"
                        class="block mt-1 w-full"
                        type="text"
                        name="description"
                        :value="old('description')"
                        required
                        placeholder="cotacte"
                        autocomplete="tel"
                    />

                    <x-input-error
                        :messages="$errors->get('description')"
                        class="mt-2"
                    />
                </div>

            </div>


            <!-- Bouton -->
            <div class="flex items-center justify-end ml-auto mt-6 w-40">
                <x-primary-button class="w-full justify-center">
                    {{ __('Enregistrer') }}
                </x-primary-button>
            </div>

      
        </form>
        </div>
        
    </x-slot>

</x-app-layout>

