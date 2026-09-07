<x-app-layout>

    <x-slot>


        <div class="w-full flex justify-center items-center ">

            <div class="w-full ">
                <div class="h-40 bg-indigo-600 py-2 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-baseline">
                    <div class="flex justify-between  items-baseline ">
                        <h1 class="text-white font-medium text-2xl max-sm:pl-2 max-sm:text-xl"> Ajout d'une zone
                        </h1>
                    </div>

                    <div class=" flex items-center justify-end  max-sm:pr-8 mb-14  w-60 max-sm:w-full max-sm:w-30">
                        <a href="{{ route('zones.index') }}">
                            <x-secondary-button
                                class="bg-white text-black py-3  hover:bg-slate-50 w-full justify-center max-sm:py-2 max-sm:text-md ">
                                {{ __('Listes') }}
                            </x-secondary-button>
                        </a>
                    </div>
                </div>


                <form class="card  mt-[-50px] p-5 mx-4 mb-6" method="POST" action="{{ route('zones.store') }}">

                    @csrf
                    <div class="grid grid-cols-1">

                        <div class="mt-4 w-full">

                            <x-input-label for="designation" :value="__('Désignation')" />

                            <x-text-input id="designation" class="block mt-1 w-full" type="text" name="designation"
                                :value="old('designation')" required autofocus />

                            <x-input-error :messages="$errors->get('designation')" class="mt-2" />

                        </div>
                    </div>


                    <div class="flex items-center justify-center mt-6 w-full">

                        <x-primary-button class="w-full justify-center py-2 hover:bg-blue-500">

                            {{ __('Enregistrer') }}

                        </x-primary-button>

                    </div>

                </form>

            </div>

        </div>

    </x-slot>

</x-app-layout>