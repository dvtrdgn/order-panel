<x-admin-layout>
    <x-breadcrumb.main>
        <x-breadcrumb.left-item class="active" aria-current="page">New User </x-breadcrumb.left-item>
        <x-slot name="title"> Create New User </x-slot>
        <x-slot name="link">
            <x-breadcrumb.right-item href="{{ route('admin.user.index') }}" class="btn-primary">User List
            </x-breadcrumb.right-item>
        </x-slot>
    </x-breadcrumb.main>
    <div class="row row-xs">
        @livewire('admin.user.create-user-component')
    </div>
</x-admin-layout>
