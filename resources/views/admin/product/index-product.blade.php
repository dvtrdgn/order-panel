<x-admin-layout>
    <x-breadcrumb.main>
        <x-breadcrumb.left-item class="active" aria-current="page">Product </x-breadcrumb.left-item>
        <x-slot name="title">Product List </x-slot>
        <x-slot name="link">
            <x-breadcrumb.right-item href="{{ route('admin.product.create') }}" class="btn-primary"><x-element.icon.new></x-element.icon.new> New Product</x-breadcrumb.right-item>
        </x-slot>
    </x-breadcrumb.main>
    <div class="row row-xs">
        @livewire('admin.product.list-product-component')
    </div>
</x-admin-layout>