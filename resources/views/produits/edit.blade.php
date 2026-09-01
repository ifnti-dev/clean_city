<x-app-layout>

    <x-slot class="">

    <div class="w-full ">
        <div class="h-40 bg-indigo-600 py-2 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-baseline">
            <div class="flex justify-between  items-baseline ">
                <h1 class="text-white font-medium text-2xl max-sm:pl-2 max-sm:text-xl">Editer un produit
                </h1>
            </div>

            <div class=" flex items-center justify-end  max-sm:pr-8 mb-14  w-60 max-sm:w-full max-sm:w-30">
                <a href="{{ route('produits.index') }}">
                    <x-secondary-button
                        class="bg-white text-black py-3  hover:bg-slate-50 w-full justify-center max-sm:py-2 max-sm:text-md ">
                        {{ __('liste') }}
                    </x-secondary-button>
                </a>
            </div>
        </div>    
   

    <div class="card  mt-[-50px] p-5 mx-4 mb-6 ">
        <form action="{{ route('produits.update', $produit->id) }}" method="POST" >
            @csrf
            @method('PUT')
            <div class="flex gap-5 justify-between">
                <div class="mt-4 w-full">
                    <x-input-label for="label" :value="__('label')" />

                    <x-text-input
                        id="label"
                        class="block mt-1 w-full"
                        type="text"
                        name="label"
                        value="{{ old('label',  $produit->label) }}"
                        required
                        autofocus
                        autocomplete="family-name"
                    />

                    <x-input-error
                        :messages="$errors->get('label')"
                        class="mt-2"
                    />
                </div>

                <div class="mt-4 w-full">
                    <x-input-label for="prenom" :value="__('prix_unitaire')" />

                    <x-text-input
                        id="prix_unitaire"
                        class="block mt-1 w-full"
                        type="text"
                        name="prix_unitaire"
                        value="{{ old('prix_unitaire',  $produit->prix_unitaire) }}"
                        required
                        autocomplete="given-name"
                    />

                    <x-input-error
                        :messages="$errors->get('prix_unitaire')"
                        class="mt-2"
                    />
                </div>
            </div>
            <!-- Nom -->
            

            <!-- Prénom -->
           

            <!-- Contact -->
            <div class="flex gap-5 justify-between">
                <div class="mt-4 w-full">
                    <x-input-label for="description" :value="__('description')" />

                    <x-text-input
                        id="description"
                        class="block mt-1 w-full"
                        type="text"
                        name="description"
                        value="{{ old('description',  $produit->description) }}"
                        required
                        autocomplete="description"
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