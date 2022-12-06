<x-admin-layout>
    <x-breadcrumb.main>
        <x-breadcrumb.left-item class="active" aria-current="page">Category </x-breadcrumb.left-item>
        <x-slot name="title">Category List </x-slot>
        <x-slot name="link">
            <x-breadcrumb.right-item href="{{ route('admin.category.create') }}" class="btn-primary"><x-element.icon.new></x-element.icon.new> New Category</x-breadcrumb.right-item>
        </x-slot>
    </x-breadcrumb.main>
    <div class="row row-xs">
        @livewire('admin.category.list-category-component')
    </div>
</x-admin-layout>