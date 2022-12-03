@props([
    'error' => false,
])
@php
    $class = 'form-control text-sm 
          block          
          px-3
          py-1.5
          text-base
          font-normal
          text-gray-700
          bg-white bg-clip-padding          
          border-gray-400
          rounded
          transition
          ease-in-out
          m-0
          focus:text-gray-700 focus:bg-white focus:shadow-lg focus:border-blue-600 focus:outline-none';
    
    if ($error) {
        $class = 'form-control text-sm
          block
          px-3
          py-1.5
          text-base
          font-normal
          text-gray-700
          bg-white bg-clip-padding          
          border-gray-400
          rounded
          transition
          ease-in-out
          m-0
          focus:text-red-700 focus:bg-white focus:shadow-lg focus:border-red-600 focus:outline-none';
    }
@endphp


<div class="mb-3 w-full">
    <label class="form-label inline-block mb-2 text-gray-700 text-sm">{{ $slot }}</label>
    <input {{ $attributes([
        'class' => $class,
    ]) }} />
</div>

@if ($error)
    <div class="mt-1 text-red-500 text-sm">{{ $error }}</div>
@endif
