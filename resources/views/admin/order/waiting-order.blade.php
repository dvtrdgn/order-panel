<x-admin-layout>
    <x-breadcrumb.main>
        <x-breadcrumb.left-item class="active" aria-current="page">Waiting Order </x-breadcrumb.left-item>
        <x-slot name="title">Waiting Order </x-slot>
        <x-slot name="link">
            <x-breadcrumb.right-item href="{{ route('admin.order.completed') }}" class="btn-primary"> <x-element.icon.list></x-element.icon.list>Completed Order
            </x-breadcrumb.right-item>
        </x-slot>
    </x-breadcrumb.main>
    <div class="row row-xs">
        @livewire('admin.order.waiting-order-component')
    </div>
</x-admin-layout>