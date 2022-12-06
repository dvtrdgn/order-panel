<x-admin-layout>
    <x-breadcrumb.main>
        <x-breadcrumb.left-item class="active" aria-current="page">New Dealer </x-breadcrumb.left-item>
        <x-slot name="title"> Create New Dealer </x-slot>
        <x-slot name="link">
            <x-breadcrumb.right-item href="{{ route('admin.dealer.index') }}" class="btn-primary"> <x-element.icon.list></x-element.icon.list> Dealer List
            </x-breadcrumb.right-item>
        </x-slot>
    </x-breadcrumb.main>
    <div class="row row-xs">
        @livewire('admin.dealer.create-dealer-component')
    </div>
</x-admin-layout>