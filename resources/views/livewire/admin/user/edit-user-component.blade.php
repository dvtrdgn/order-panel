<div class="col-md-12 card shadow-md hover:shadow-xl">
    <fieldset class="form-fieldset mg-10">
        <legend>User Information</legend>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group ">
                    <label class="form-label">Dealer </label>
                    <select wire:model="user.dealer_id" name="dealer_id" class="form-control">
                        <option value="">Select Dealer</option>
                        @foreach ($dealers as $dealer)
                        <option value="{{ $dealer->id }}">{{ $dealer->name }}</option>
                        @endforeach
                    </select>
                    @error('user.dealer_id')
                    <p class="text-danger my-3">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <x-form.input autocomplete="one-time-code" wire:model="user.name" :error="$errors->first('user.name')">Name</x-form.input>
            </div>
            <div class="col-md-6">
                <x-form.input autocomplete="one-time-code" wire:model="user.email" :error="$errors->first('user.email')">Email</x-form.input>
            </div>

            <div class="col-md-3 my-10">
                <x-form.label class="font-bold">Status</x-form.label>
                <x-form.radio-button>
                    <x-slot name="label1">
                        <input type="radio" wire:model="user.status" id="customRadio1" name="status" class="custom-control-input" value="{{ \App\Enums\Status::Active->value }}">
                        <label class="custom-control-label" for="customRadio1">Active User</label>
                    </x-slot>
                    <x-slot name="label2">
                        <input type="radio" wire:model="user.status" id="customRadio2" name="status" class="custom-control-input" value="{{ \App\Enums\Status::Passive->value }}">
                        <label class="custom-control-label" for="customRadio2">Passive User</label>
                    </x-slot>
                </x-form.radio-button>
            </div>
            <div class="col-md-3 my-10">
                <x-form.label class="font-bold">Role</x-form.label>
                <x-form.radio-button>
                    <x-slot name="label1">
                        <input type="radio" wire:model="user.role" id="customRadio4" name="role" class="custom-control-input" value="{{ \App\Enums\Role::User->value }}">
                        <label class="custom-control-label" for="customRadio4">User</label>
                    </x-slot>
                    <x-slot name="label2">
                        <input type="radio" wire:model="user.role" id="customRadio3" name="role" class="custom-control-input" value="{{ \App\Enums\Role::Admin->value }}">
                        <label class="custom-control-label" for="customRadio3">Admin</label>
                    </x-slot>
                </x-form.radio-button>
            </div>
            <div class="col-md-6 my-10">
                <div class="row" x-data="{isUploading:false, progress:5}" x-on:livewire-upload-start="isUploading=true" x-on:livewire-upload-finish="isUploading=false, progress=5" x-on:livewire-upload-error="isUploading=false" x-on:livewire-upload-progress="progress=$event.detail.progress">
                    <div class="col-12">
                        <div class="form-group">
                            <div class="custom-file">
                                <x-form.image-upload wire:model="new_image" :error="$errors->first('new_image')"></x-form.image-upload>
                            </div>
                            <div class="progress my-3" x-show.transition="isUploading">
                                <div class="progress-bar progress-bar-striped bg-success" role="progressbar" x-bind:style="`width: ${progress}%`" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-auto">
                        @if ($new_image)
                        <img class="imageList p-3 my-3" src="{{ $new_image->temporaryUrl() }}" alt="image">
                        @else
                        <img class="imageList p-3 my-3" src="{{ asset('assets/images/user') }}/{{ $user->profile_photo_path }}" alt="">
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <x-form.button class="float-right" wire:click="save" :error="$errors">
            Save
        </x-form.button>
    </fieldset>
</div>
