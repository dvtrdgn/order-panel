@props([
    'error' => false,
])
@php
    $class = 'text-white bg-blue-700 hover:bg-blue-800 focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-5 py-2.5 text-center  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-400 inline-flex items-center cursor-not-allowed';
@endphp
<button {{ $attributes(['class' => $class]) }} @if ($errors->any()) @disabled(true) @endif>
    <span wire:loading>
     <x-element.icon.loading></x-element.icon.loading>
    </span>
    {{ $slot }}
</button>
