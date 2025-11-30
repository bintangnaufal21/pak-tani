@props(['class' => ''])

<div {{ $attributes->merge([
    'class' => "bg-white rounded-lg shadow-sm $class"
]) }}>
    {{ $slot }}
</div>
