<x-app-layout>
    <x-slot>

        <div class="h-40 bg-indigo-600 py-2 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-baseline">
            <div class="flex justify-between  items-baseline ">
                <h1 class="text-white font-medium text-2xl max-sm:pl-2 max-sm:text-xl">Ajouter une facture
                </h1>
            </div>
        </div>

        <div class=" card  mt-[-50px] p-5 mx-4 mb-6 ">
            <form method="POST" action="{{ route('factures.store') }}" class="formulaire">
                @csrf
                <section class="etape active" id="etape1">
                    <h1>Etape 1</h1>
                    <div class="flex flex-col gap-5 justify-between">


                        <div class="flex gap-5 justify-between">
                            <div class="mt-4 w-full">
                                <x-input-label for="tarif" :value="__('Tarif')" />

                                <select name="tarif_id" id="tarif_id" placholder="" class="w-full rounded-lg">
                                    <option value="">Choisissez Le Tarif </option>
                                    @foreach ($tarifs as $tarif)
                                        <option @selected(old('tarif_id') == $tarif->id) value="{{ $tarif->id }}"
                                            data-montant="{{ $tarif->montant }}">
                                            {{ $tarif->designation . '  à ' . $tarif->montant }}</option>

                                        <div id="{{ $tarif->id }}"></div>
                                    @endforeach

                                </select>

                                <div id="tarif_erreure" class="mt-2 text-red-500">

                                </div>
                            </div>


                            <div class="mt-4 w-full">
                                <x-input-label for="abonnement" :value="__('Abonnee')" />

                                <select name="abonnement_id" id="abonnement_id" placholder=""
                                    class="w-full rounded-lg">
                                    <option value="">Choisissez L'abonnement </option>
                                    @foreach ($abonnements as $abonnement)
                                        <option @selected(old('abonnement_id') == $abonnement->id) value="{{ $abonnement->id }}">
                                            {{ $abonnement->menage->designation }}</option>
                                    @endforeach
                                </select>

                                <div id="abonnement_erreure" class="mt-2 text-red-500">

                                </div>

                            </div>

                        </div>

                        {{-- les mois --}}
                        <div class="flex flex-col">
                            <div class="flex flex-col text-x mt-4 ">
                                <x-input-label for="" :value="__('Choisire Les mois')" />
                            </div>

                            <div class="flex w-full pt-0 mt-4 justify-between">
                                <div class="flex flex-col  gap-5 p-10 justify-between">

                                    <div class="mt-4 flex flex-row  items-center gap-2 w-full">
                                        <input type="checkbox" id="janvier" name="lesmois[]" value="janvier"
                                            class="lesmois" data-indice="1">
                                        <x-input-label for="janvier" :value="__('Janvier')" />
                                    </div>

                                    <div class="mt-4 flex flex-row items-center gap-2 w-full">
                                        <input type="checkbox" id="fevrier" name="lesmois[]" value="fevrier"
                                            class="lesmois" data-indice="2">
                                        <x-input-label for="fevrier" :value="__('fevrier')" />
                                    </div>

                                    <div class="mt-4 flex flex-row items-center gap-2 w-full">
                                        <input type="checkbox" id="mars" name="lesmois[]" value="mars"
                                            class="lesmois" data-indice="3">
                                        <x-input-label for="mars" :value="__('mars')" />
                                    </div>

                                </div>

                                <div class="flex flex-col gap-5 p-10 justify-between">
                                    <div class="mt-4 flex flex-row items-center gap-2 w-full">
                                        <input type="checkbox" id="avril" name="lesmois[]" value="avril"
                                            class="lesmois" data-indice="4">
                                        <x-input-label for="avril" :value="__('avril')" />
                                    </div>

                                    <div class="mt-4 flex flex-row items-center gap-2 w-full">
                                        <input type="checkbox" id="mai" name="lesmois[]" value="mai"
                                            class="lesmois" data-indice="5">
                                        <x-input-label for="mai" :value="__('mai')" />
                                    </div>

                                    <div class="mt-4 flex flex-row items-center gap-2 w-full">
                                        <input type="checkbox" id="juin" name="lesmois[]" value="juin"
                                            class="lesmois" data-indice="6">
                                        <x-input-label for="juin" :value="__('juin')" />
                                    </div>
                                </div>

                                <div class="flex flex-col gap-5 p-10 justify-between">
                                    <div class="mt-4 flex flex-row items-center gap-2 w-full">
                                        <input type="checkbox" id="juillet" name="lesmois[]" value="juillet"
                                            class="lesmois" data-indice="7">
                                        <x-input-label for="juillet" :value="__('juillet')" />
                                    </div>

                                    <div class="mt-4 flex flex-row items-center gap-2 w-full">
                                        <input type="checkbox" id="Aoute" name="lesmois[]" value="aoute"
                                            class="lesmois" data-indice="8">
                                        <x-input-label for="Aoute" :value="__('Aoute')" />
                                    </div>

                                    <div class="mt-4 flex flex-row items-center gap-2 w-full">
                                        <input type="checkbox" id="septembre" name="lesmois[]" value="septembre"
                                            class="lesmois" data-indice="9">
                                        <x-input-label for="septembre" :value="__('septembre')" />
                                    </div>
                                </div>

                                <div class="flex flex-col gap-5 p-10 justify-between">
                                    <div class="mt-4 flex flex-row items-center gap-2 w-full">
                                        <input type="checkbox" id="octobre" name="lesmois[]" value="octobre"
                                            class="lesmois" data-indice="10">
                                        <x-input-label for="octobre" :value="__('octobre')" />
                                    </div>

                                    <div class="mt-4 flex flex-row items-center gap-2 w-full">
                                        <input type="checkbox" id="novembre" name="lesmois[]" value="novembre"
                                            class="lesmois" data-indice="11">
                                        <x-input-label for="novembre" :value="__('novembre')" />
                                    </div>

                                    <div class="mt-4 flex flex-row items-center gap-2 w-full">
                                        <input type="checkbox" id="decembre" name="lesmois[]" value="decembre"
                                            class="lesmois" data-indice="12">
                                        <x-input-label for="decembre" :value="__('decembre')" />
                                    </div>

                                </div>
                            </div>

                            <div id="mois_erreure" class="mt-2 text-red-500 -mb-px ">
                            </div>

                        </div>


                    </div>

                    <div class="flex items-center justify-end ml-auto mt-6 w-40" id="btnSuivant1">
                        <x-secondary1-button class="w-full">
                            suivant
                        </x-secondary1-button>
                    </div>


                </section>

                <section class="etape" id="etape2">
                    <h1>Etape 2</h1>
                    <div class="flex gap-5 justify-between">

                        <div class="mt-4 w-full">
                            <x-input-label for="date_debut" :value="__('Date Debut')" />

                            <x-text-input id="date_debut" class="block mt-1 w-full" type="date" name="date_debut"
                                :value="now()->format('Y-m-d')" readonly required placeholder="date_debut"
                                autocomplete="given-name" />

                            <x-input-error :messages="$errors->get('date_debut')" class="mt-2" />

                        </div>

                        {{-- date fin --}}
                        <div class="mt-4 w-full">
                            <x-input-label for="date_fin" :value="__('Date Fin')" />

                            <x-text-input id="date_fin" class="block mt-1 w-full" type="date" name="date_fin"
                                :value="old('date_fin')" readonly placeholder="date_fin" autocomplete="given-name" />


                            <x-input-error :messages="$errors->get('date_fin')" class="mt-2" />
                        </div>

                        <!-- MOisl -->
                    </div>

                    <div class="flex gap-5 justify-between">

                        <div class="mt-4 w-full">
                            <x-input-label for="methode_paiement" :value="__('Methode de paiement')" />

                            <select name="methode_paiement_id" id="methode_paiement_id" placholder=""
                                class="w-full rounded-lg">
                                <option value="">Choisissez Le mode de paiement </option>
                                @foreach ($methode_paiements as $methode_paiement)
                                    <option @selected(old('methode_paiement_id') == $methode_paiement->id) value="{{ $methode_paiement->id }}">
                                        {{ $methode_paiement->type }}</option>
                                @endforeach

                            </select>
                            <x-input-error :messages="$errors->get('methode_paiement_id')" class="mt-2" />

                        </div>

                        <div class="mt-4 w-full">
                            <x-input-label for="montant" :value="__('Montant')" />

                            <x-text-input id="montant" class="block mt-1 w-full" type="text" name="montant"
                                required placeholder="montant" readonly autocomplete="given-name" />

                            <x-input-error :messages="$errors->get('montant')" class="mt-2" />
                        </div>
                    </div>
                    
                    <div class="flex flex-row gap-5 justify-between">
                        <div class="flex items-center justify-end mr-auto mt-4 w-40 " id="btnPrecedent1">
                            <x-secondary1-button class="w-full justify-center">
                                Pecedant
                            </x-secondary1-button>
                        </div>

                        <!-- Bouton -->
                        <div class="flex items-center justify-end ml-auto mt-4 w-40" id="btnEnregistrer">
                            <x-primary-button class="w-full justify-center">
                                {{ __('Enregistrer') }}
                            </x-primary-button>
                        </div>
                    </div>

                </section>
            </form>
        </div>

    </x-slot>

</x-app-layout>
