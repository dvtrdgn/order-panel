<x-admin-layout>
    <x-breadcrumb.main>
        <x-breadcrumb.left-item class="active" aria-current="page">Edit Product </x-breadcrumb.left-item>
        <x-slot name="title"> Edit Product Information</x-slot>
        <x-slot name="link">
            <x-breadcrumb.right-item href="{{ route('admin.product.index') }}" class="btn-primary">Product List
            </x-breadcrumb.right-item>
        </x-slot>
    </x-breadcrumb.main>
    <div class="row row-xs">
        @livewire('admin.product.edit-product-component',['product_id'=>$product_id])
    </div>
</x-admin-layout>