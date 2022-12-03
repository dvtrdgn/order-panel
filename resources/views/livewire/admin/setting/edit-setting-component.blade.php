<div class="shadow-md hover:shadow-xl ">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <x-tab.nav-item class="active" href="#home" aria-controls="home" aria-selected="true" id="home-tab"> Information
        </x-tab.nav-item>
        <x-tab.nav-item href="#profile" aria-controls="profile" aria-selected="true" id="profile-tab"> Profile
        </x-tab.nav-item>
    </ul>
    <div class="tab-content bd bd-gray-300 bd-t-0 pd-20" id="myTabContent ">
        <x-tab.tab-pane class="show active" id="home" aria-labelledby="home-tab">
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
        </x-tab.tab-pane>
        <x-tab.tab-pane id="profile" aria-labelledby="profile-tab">
            profile
            <h1>Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam illum autem reprehenderit quam eligendi
                quia voluptas quod quis suscipit officia temporibus blanditiis earum magni praesentium placeat
                voluptatem, id cumque tenetur.</h1>
        </x-tab.tab-pane>
        <div class="flex  justify-end">
            <x-form.button wire:click="save" :error="$errors">
                Update Setting
            </x-form.button>
        </div>
    </div>
</div>
