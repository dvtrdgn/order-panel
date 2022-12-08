<div class="col-md-12 card shadow-md hover:shadow-xl">
    <fieldset class="form-fieldset mg-10">
        <legend>User Information</legend>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group ">
                    <label class="form-label">Dealer <span class="text-red">*</span></label>
                    <select wire:model="dealer_id" name="dealer_id" class="form-control">
                        <option value="">Select Dealer</option>
                        @foreach ($dealers as $dealer)
                        <option value="{{ $dealer->id }}">{{ $dealer->name }}</option>
                        @endforeach
                    </select>
                    @error('dealer_id')
                    <p class="text-danger my-3">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <x-form.input autocomplete="one-time-code" wire:model="name" :error="$errors->first('name')">Name</x-form.input>
            </div>
            <div class="col-md-6">
                <x-form.input autocomplete="one-time-code" wire:model="email" :error="$errors->first('email')">Email</x-form.input>
            </div>
            <div class="col-md-3">
                <x-form.input autocomplete="one-time-code" type="password" wire:model="password" :error="$errors->first('password')">
                    Password</x-form.input>
            </div>
            <div class="col-md-3">
                <x-form.input autocomplete="one-time-code" type="password" wire:model="password_confirmation" :error="$errors->first('password_confirmation')">Confirm Password</x-form.input>
            </div>
            <div class="col-md-2 my-10">
                <x-form.label class="font-bold">Status</x-form.label>
                <x-form.radio-button>
                    <x-slot name="label1">
                        <input type="radio" wire:model="status" id="customRadio1" name="status" class="custom-control-input" value="{{ \App\Enums\Status::Active->value }}">
                        <label class="custom-control-label" for="customRadio1">Active User</label>
                    </x-slot>
                    <x-slot name="label2">
                        <input type="radio" wire:model="status" id="customRadio2" name="status" class="custom-control-input" value="{{ \App\Enums\Status::Passive->value }}">
                        <label class="custom-control-label" for="customRadio2">Passive User</label>
                    </x-slot>
                </x-form.radio-button>
            </div>
            <div class="col-md-2 my-10">
                <x-form.label class="font-bold">Role</x-form.label>
                <x-form.radio-button>
                    <x-slot name="label1">
                        <input type="radio" wire:model="role" id="customRadio4" name="role" class="custom-control-input" value="{{ \App\Enums\Role::User->value }}">
                        <label class="custom-control-label" for="customRadio4">User</label>
                    </x-slot>
                    <x-slot name="label2">
                        <input type="radio" wire:model="role" id="customRadio3" name="role" class="custom-control-input" value="{{ \App\Enums\Role::Admin->value }}">
                        <label class="custom-control-label" for="customRadio3">Admin</label>
                    </x-slot>
                </x-form.radio-button>
            </div>
            <div class="col-md-2 my-10">
                <div class="row" x-data="{isUploading:false, progress:5}" x-on:livewire-upload-start="isUploading=true" x-on:livewire-upload-finish="isUploading=false, progress=5" x-on:livewire-upload-error="isUploading=false" x-on:livewire-upload-progress="progress=$event.detail.progress">
                    <div class="col-12">
                        <div class="form-group">
                            <div class="custom-file">
                                <x-form.image-upload wire:model="image" :error="$errors->first('image')"></x-form.image-upload>
                            </div>
                            <div class="progress my-3" x-show.transition="isUploading">
                                <div class="progress-bar progress-bar-striped bg-success" role="progressbar" x-bind:style="`width: ${progress}%`" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-auto">
                        @if ($image)
                        <img src="{{ $image->temporaryUrl() }}" alt="image" class="imageList my-3">
                        @else
                        <img src="{{ asset('assets/images/static') }}/1660910188_user.png" class="imageList my-10" style="padding: 20px;" alt="">
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
