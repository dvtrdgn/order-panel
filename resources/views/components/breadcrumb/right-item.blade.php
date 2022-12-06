<x-element.link.primary {{$attributes}}>{{$slot}}</x-element.link.primary>

@if(!request()->routeIs('admin.dashboard'))
<x-element.link.light class="ml-3" href="{{route('admin.dashboard')}}">
    <x-element.icon.home></x-element.icon.home> Home
</x-element.link.light>
@endif