<x-admin-layout>
    <x-breadcrumb.main>
        <x-breadcrumb.left-item class="active" aria-current="page">Edit Category </x-breadcrumb.left-item>
        <x-slot name="title"> Edit Category Information</x-slot>
        <x-slot name="link">
            <x-breadcrumb.right-item href="{{ route('admin.category.index') }}" class="btn-primary">Category List
            </x-breadcrumb.right-item>
        </x-slot>
    </x-breadcrumb.main>
    <div class="row row-xs">
        @livewire('admin.category.edit-category-component',['edited_category_id'=>$category_id])
    </div>
</x-admin-layout>