
@props([
    'error' => false,
])
    <label class="form-label inline-block mb-2 text-gray-700 text-sm">   
    </label>
<select
    {{ $attributes([
        'class' => 'form-select appearance-none
          block
          w-full
          px-3
          py-1.5
          text-base
          font-normal
          text-gray-400
          bg-white bg-clip-padding bg-no-repeat
          border-gray-400
          rounded
          transition
          ease-in-out
          m-0
          focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none',
    ]) }}
    aria-label="Default select example">
    {{ $slot }}
</select>
