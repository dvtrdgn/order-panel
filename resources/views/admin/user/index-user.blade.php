<x-admin-layout>


    <x-breadcrumb.main>
        <x-breadcrumb.left-item class="active" aria-current="page">Breadcrumb link 2 </x-breadcrumb.left-item>
        <x-slot name="title"> Title </x-slot>
        <x-slot name="link">
            <x-breadcrumb.right-item href="{{ route('admin.dealer.index') }}" class="btn-primary"> <i
                    data-feather="printer" class="wd-10 mg-r-5"></i>Link 1</x-breadcrumb.right-item>
        </x-slot>
    </x-breadcrumb.main>

    <div class="row row-xs">

    </div>

</x-admin-layout>
