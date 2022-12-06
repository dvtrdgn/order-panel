<x-admin-layout>
    <x-breadcrumb.main>
        <x-breadcrumb.left-item class="active" aria-current="page">New Category </x-breadcrumb.left-item>
        <x-slot name="title"> Create New Category </x-slot>
        <x-slot name="link">
            <x-breadcrumb.right-item href="{{ route('admin.category.index') }}" class="btn-primary"> <x-element.icon.list></x-element.icon.list> Category List
            </x-breadcrumb.right-item>
        </x-slot>
    </x-breadcrumb.main>
    <div class="row row-xs">
        @livewire('admin.category.create-category-component')
    </div>
</x-admin-layout>