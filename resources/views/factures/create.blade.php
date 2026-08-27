<x-app-layout>

    <x-slot>


        <div class="flex justify-center items-center mb-6 " >
            <h3 class="text-blue-700 font-bold pt-7 pr-2 text-2xl">
               Ajouter un paiement
            </h3>
        </div>

        <div class="bg-white  rounded-md shadow m-6 p-6">
            <form method="POST" action="{{ route('factures.store') }}" >
            @csrf
            <div class="flex gap-5 justify-between">
                 <!-- nb_mois-->
                <div class="mt-4 w-full">
                    <x-input-label for="nb_mois" :value="__('Nombre de mois')" />

                    <x-text-input
                        id="nb_mois"
                        class="block mt-1 w-full"
                        type="text"
                        name="nb_mois"
                        :value="old('nb_mois')"
                        required
                        autofocus
                        placeholder="Nombre de mois"
                        autocomplete="family-name"
                    />

                    <x-input-error
                        :messages="$errors->get('nb_mois')"
                        class="mt-2"
                    />
                </div>

                <div class="mt-4 w-full">
                    <x-input-label for="montant" :value="__('Montant')" />

                    <x-text-input
                        id="montant"
                        class="block mt-1 w-full"
                        type="number"
                        name="montant"
                        required
                        placeholder="montant"
                        autocomplete="given-name"
                    />

                    <x-input-error
                        :messages="$errors->get('montant')"
                        class="mt-2"
                    />
                </div>

            </div>
           
            <div class="flex gap-5 justify-between">

                <div class="mt-4 w-full">
                    <x-input-label for="date_debut" :value="__('Date Debut')" />

                    <x-text-input
                        id="date_debut"
                        class="block mt-1 w-full"
                        type="date"
                        name="date_debut"
                        :value="old('date_debut')"
                        required
                        placeholder="date_debut"
                        autocomplete="given-name"
                    />

                    <x-input-error
                        :messages="$errors->get('date_debut')"
                        class="mt-2"
                    />
                </div>

                {{-- date fin --}}
                <div class="mt-4 w-full">
                    <x-input-label for="date_fin" :value="__('Date Fin')" />

                    <x-text-input
                        id="date_fin"
                        class="block mt-1 w-full"
                        type="date"
                        name="date_fin"
                        :value="old('date_fin')"
                        required
                        placeholder="date_fin"
                        autocomplete="given-name"
                    />

                    <x-input-error
                        :messages="$errors->get('date_fin')"
                        class="mt-2"
                    />
                </div>

                <!-- MOisl -->
            </div>   


             <div class="flex gap-5 justify-between">

               <div class="mt-4 w-full">
                    <x-input-label for="methode_paiement" :value="__('Methode de paiement')" />

                        <select name="methode_paiement_id" id="methode_paiement_id" placholder="" class="w-full rounded-lg">
                            @foreach ( $methode_paiements as $methode_paiement )
                            <option @selected(old('methode_paiement_id')==$methode_paiement->id) value="{{ $methode_paiement->id }}">{{ $methode_paiement->type }}</option>
                            @endforeach
                        </select>

                    <x-input-error :messages="$errors->get('methode_paiement_id')" class="mt-2" />
                </div>

                <div class="mt-4 w-full">
                    <x-input-label for="tarif" :value="__('Tarif')" />

                        <select name="tarif_id" id="tarif_id" placholder="" class="w-full rounded-lg">
                            @foreach ( $tarifs as $tarif )
                            <option @selected(old('tarif_id')==$tarif->id) value="{{ $tarif->id }}">{{ $tarif->designation. "  à ".$tarif->montant  }}</option>
                            @endforeach
                        </select>

                    <x-input-error :messages="$errors->get('tarif_id')" class="mt-2" />
                </div>
               
            </div>  
            
            <div class="flex gap-5 justify-between">
                <div class="mt-4 w-full">
                    <x-input-label for="abonnement" :value="__('Abonnement')" />

                        <select name="abonnement_id" id="abonnement_id" placholder="" class="w-full rounded-lg">
                            @foreach ( $abonnements as $abonnement )
                            <option @selected(old('abonnement_id')==$abonnement->id) value="{{ $abonnement->id }}">{{ $abonnement->designation. "  à ".$abonnement->montant  }}</option>
                            @endforeach
                        </select>

                    <x-input-error :messages="$errors->get('abonnement_id')" class="mt-2" />
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

