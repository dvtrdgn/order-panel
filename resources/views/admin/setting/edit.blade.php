<x-admin-layout>
    <x-breadcrumb.main>
        <x-breadcrumb.left-item class="active" aria-current="page">Edit Setting </x-breadcrumb.left-item>
        <x-slot name="title"> Update global setting parameter </x-slot>
        <x-slot name="link">
            <x-breadcrumb.right-item href="{{ route('admin.dealer.index') }}" class="btn-primary"> <i
                    data-feather="printer" class="wd-10 mg-r-5"></i>Link 1</x-breadcrumb.right-item>
        </x-slot>
    </x-breadcrumb.main>
    @livewire('admin.setting.edit-setting-component')
</x-admin-layout>
