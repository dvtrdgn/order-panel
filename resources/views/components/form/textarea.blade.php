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
          text-red-700
          border-red-600
          bg-white bg-clip-padding          
          border-gray-400
          rounded
          transition
          ease-in-out
          m-0
          focus:text-red-700 focus:bg-white focus:shadow-lg focus:border-red-600 focus:outline-none';
    }
@endphp
<textarea {{ $attributes(['class' => $class]) }} rows="2">{{ $slot }}</textarea>
@if ($error)
   <x-form.error>{{$error}}</x-form.error>
@endif