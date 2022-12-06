<x-admin-layout>


    <x-breadcrumb.main>
        <x-breadcrumb.left-item class="active" aria-current="page">Users </x-breadcrumb.left-item>
        <x-slot name="title"> User List </x-slot>
        <x-slot name="link">
            <x-breadcrumb.right-item href="{{ route('admin.user.create') }}" class="btn-primary"> <i
                    data-feather="plus" class="wd-10 mg-r-5"></i>New User</x-breadcrumb.right-item>
        </x-slot>
    </x-breadcrumb.main>

    <div class="row row-xs">
        @livewire('admin.user.list-user-component')
    </div>

</x-admin-layout>
