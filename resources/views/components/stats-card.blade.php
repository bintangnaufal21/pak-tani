@props(['title' => '', 'value' => ''])

<div {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow-sm p-4']) }}>
  <div class="text-sm text-gray-500">{{ $title }}</div>
  <div class="mt-2 text-2xl font-bold text-gray-900">{{ $value }}</div>
</div>
