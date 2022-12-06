<div class="card shadow-md hover:shadow-xl">
    <fieldset class="form-fieldset mg-10">
        <legend>Site Information</legend>
        <div class="row row-sm ">
            <div class="col-md-4">
                <x-form.input wire:model="setting.name" :error="$errors->first('setting.name')">Name</x-form.input>
            </div>
            <div class="col-md-4">
                <x-form.input wire:model="setting.title" :error="$errors->first('setting.title')">Title</x-form.input>
            </div>
            <div class="col-md-4">
                <x-form.input wire:model="setting.author" :error="$errors->first('setting.author')">Author</x-form.input>
            </div>
            <div class="col-md-4">
                <x-form.input wire:model="setting.site_url" :error="$errors->first('setting.site_url')">Site URL</x-form.input>
            </div>
            <div class="col-md-4">
                <x-form.input wire:model="setting.copy" :error="$errors->first('setting.copy')">Site Copy</x-form.input>
            </div>
            <div class="col-md-4">
                <x-form.input wire:model="setting.keywords" :error="$errors->first('setting.keywords')">Keywords</x-form.input>
            </div>
        </div>
    </fieldset>
    <fieldset class="form-fieldset mg-10">
        <legend>Contact</legend>
        <div class="row row-sm">
            <div class="col-md-6">
                <x-form.input wire:model="setting.email1" :error="$errors->first('setting.email1')">Office Email</x-form.input>
            </div>
            <div class="col-md-6">
                <x-form.input wire:model="setting.email2" :error="$errors->first('setting.email2')">Factory Email</x-form.input>
            </div>
            <div class="col-md-6">
                <x-form.input wire:model="setting.phone1" :error="$errors->first('setting.phone1')">Office Phone</x-form.input>
            </div>
            <div class="col-md-6">
                <x-form.input wire:model="setting.phone2" :error="$errors->first('setting.phone2')">Factory Phone</x-form.input>
            </div>
            <div class="col-md-6">
                <x-form.label>Office Address</x-form.label>
                <x-form.textarea wire:model="setting.address1" :error="$errors->first('setting.address1')">{{ $setting->address1 }}
                </x-form.textarea>
            </div>
            <div class="col-md-6">
                <x-form.label>Factory Address</x-form.label>
                <x-form.textarea wire:model="setting.address2" :error="$errors->first('setting.address2')">{{ $setting->address2 }}
                </x-form.textarea>
            </div>
        </div>
        <x-form.button class="float-right my-3" wire:click="save" :error="$errors">
            Update Setting
        </x-form.button>
    </fieldset>
</div>
