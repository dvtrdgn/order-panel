 @props(['active' => false])
 @php
     $classes = 'nav-item';
     if ($active) {
         $classes = 'nav-item active';
     }
 @endphp
 <li {{ $attributes(['class' => $classes]) }}>
     {{ $slot }}
 </li>
