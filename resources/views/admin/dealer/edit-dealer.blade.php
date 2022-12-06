<x-admin-layout>
    <x-breadcrumb.main>
        <x-breadcrumb.left-item class="active" aria-current="page">Edit Dealer </x-breadcrumb.left-item>
        <x-slot name="title"> Edit Dealer Information</x-slot>
        <x-slot name="link">
            <x-breadcrumb.right-item href="{{ route('admin.dealer.index') }}" class="btn-primary">Dealer List
            </x-breadcrumb.right-item>
        </x-slot>
    </x-breadcrumb.main>
    <div class="row row-xs">
        @livewire('admin.dealer.edit-dealer-component',['dealer_id'=>$dealer_id])
    </div>
</x-admin-layout>