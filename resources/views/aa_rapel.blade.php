@if ($abonnement->menage->est_en_regle==0 || $abonnement->etat=="ACTIF" )
@else
@endif



<div class="flex items-end justify-end gap-2 max-sm:flex-col max-sm:gap-2 max-sm:w-full">
    <a href="{{ route('tournees.index') }}" class="">
        <x-secondary-button
            class="bg-white text-black py-3   hover:bg-slate-50 justify-center max-sm:py-2 max-sm:text-md ">
            {{ __('Listes') }}
        </x-secondary-button>
    </a>

    <a href="{{ route('tournees.edit', $tournee->id) }}" class="">
        <x-secondary-button
            class="bg-yellow-500 text-black py-3  hover:bg-yellow-400  justify-center max-sm:py-2 max-sm:text-md ">
            {{ __('Modifier') }}
        </x-secondary-button>
    </a>
</div>




<div class="h-40 bg-indigo-600 py-2 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-baseline">
    <div class="flex justify-between  items-baseline ">
        <h3 class="text-2xl font-semibold text-white max-sm:pl-2 max-sm:text-xl max-sm:w-72">
            Détails de l'employé
        </h3>
    </div>

    <div class="flex items-end justify-end gap-2 max-sm:flex-col max-sm:gap-2 max-sm:w-full">
        <a href="{{ route('employes.index') }}" class="">
            <x-secondary-button
                class="bg-white text-black py-3   hover:bg-slate-50 justify-center max-sm:py-2 max-sm:text-md ">
                {{ __('Listes') }}
            </x-secondary-button>
        </a>

        <a href="{{ route('employes.edit',$employe->id) }}">
            <x-secondary-button
                class="bg-yellow-500 text-black py-3  hover:bg-yellow-400  justify-center max-sm:py-2 max-sm:text-md ">
                {{ __('Modifier') }}
            </x-secondary-button>
        </a>
    </div>

</div>