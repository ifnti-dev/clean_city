@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-ld text-gray-800 ']) }}>
    {{ $value ?? $slot }}
</label>
