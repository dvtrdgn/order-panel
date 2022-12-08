<x-admin-layout>
    <x-breadcrumb.main>
        <x-breadcrumb.left-item class="active" aria-current="page">Dashboard Home </x-breadcrumb.left-item>
        <x-slot name="title"> Welcome @auth
            {{Auth::user()->name}}
        @endauth </x-slot>
        <x-slot name="link">
            <x-breadcrumb.right-item href="{{ route('admin.setting.edit') }}"><x-element.icon.setting></x-element.icon.setting> Setting</x-breadcrumb.right-item>
        </x-slot>
    </x-breadcrumb.main>
    @livewire('admin.dashboard-component')
</x-admin-layout>