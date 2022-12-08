@props([
    'error' => false,
])
@php
    $class = 'inline-block px-2 py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out';
@endphp
<button {{ $attributes(['class' => $class]) }} @if ($errors->any()) @disabled(true) @endif>
    <span wire:loading>
     <x-element.icon.loading></x-element.icon.loading>
    </span>
    {{ $slot }}
</button>