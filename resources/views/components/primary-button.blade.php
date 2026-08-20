<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn gap-x-2 bg-blue-700 text-white
                                          border-blue-700 disabled:opacity-50 disabled:pointer-events-none
                                          hover:text-white hover:bg-blue-700 hover:border-blue-700 active:bg-blue-700
                                          active:border-blue-700 focus:outline-none focus:ring-4
                                          focus:ring-blue-300']) }}>
    {{ $slot }}
</button>
