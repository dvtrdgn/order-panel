<x-admin-layout>
    <x-breadcrumb.main>
        <x-breadcrumb.left-item class="active" aria-current="page">New Product </x-breadcrumb.left-item>
        <x-slot name="title"> Create New Product </x-slot>
        <x-slot name="link">
            <x-breadcrumb.right-item href="{{ route('admin.product.index') }}" class="btn-primary"> <x-element.icon.list></x-element.icon.list> Product List
            </x-breadcrumb.right-item>
        </x-slot>
    </x-breadcrumb.main>
    <div class="row row-xs">
        @livewire('admin.product.create-product-component')
    </div>
</x-admin-layout>