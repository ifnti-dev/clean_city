@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => ' focus:border-green-500  rounded-md shadow-sm']) }}>
