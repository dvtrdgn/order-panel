<x-admin-layout>
    <x-breadcrumb.main>
        <x-breadcrumb.left-item class="active" aria-current="page">Dealers </x-breadcrumb.left-item>
        <x-slot name="title">Dealer List </x-slot>
        <x-slot name="link">
            <x-breadcrumb.right-item href="{{ route('admin.dealer.create') }}" class="btn-primary"><x-element.icon.new></x-element.icon.new> New Dealer</x-breadcrumb.right-item>
        </x-slot>
    </x-breadcrumb.main>
    <div class="row row-xs">
        @livewire('admin.dealer.list-dealer-component')
    </div>
</x-admin-layout>