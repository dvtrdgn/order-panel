<x-admin-layout>
    <x-breadcrumb.main>
        <x-breadcrumb.left-item class="active" aria-current="page">Completed Order </x-breadcrumb.left-item>
        <x-slot name="title">Completed Order </x-slot>
        <x-slot name="link">
            <x-breadcrumb.right-item href="{{ route('admin.order.waiting') }}" class="btn-primary"> <x-element.icon.list></x-element.icon.list>Order List
            </x-breadcrumb.right-item>
        </x-slot>
    </x-breadcrumb.main>
    <div class="row row-xs">
        @livewire('admin.order.completed-order-component')
    </div>
</x-admin-layout>