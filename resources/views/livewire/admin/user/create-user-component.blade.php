<div class="col-md-12">
    <fieldset class="form-fieldset">
        <legend>User Information</legend>

        <div class="row">
            <div class="col-md-6">
                <x-form.input autocomplete="one-time-code" wire:model="name" :error="$errors->first('name')">Name</x-form.input>
            </div>
            <div class="col-md-6">
                <x-form.input autocomplete="one-time-code" wire:model="email" :error="$errors->first('email')">Email</x-form.input>
            </div>
            <div class="col-md-6">
                <x-form.input autocomplete="one-time-code" type="password" wire:model="password" :error="$errors->first('password')">
                    Password</x-form.input>
            </div>
            <div class="col-md-6">
                <x-form.input autocomplete="one-time-code" type="password" wire:model="password_confirmation"
                    :error="$errors->first('password_confirmation')">Confirm Password</x-form.input>
            </div>
            <div class="col-md-3 my-10">
                <x-form.label class="font-bold">Status</x-form.label>
                <x-form.radio-button>
                    <x-slot name="label1">
                        <input type="radio" wire:model="status" id="customRadio1" name="status"
                            class="custom-control-input" value="{{ \App\Enums\Status::Active->value }}">
                        <label class="custom-control-label" for="customRadio1">Active User</label>
                    </x-slot>
                    <x-slot name="label2">
                        <input type="radio" wire:model="status" id="customRadio2" name="status"
                            class="custom-control-input" value="{{ \App\Enums\Status::Passive->value }}">
                        <label class="custom-control-label" for="customRadio2">Passive User</label>
                    </x-slot>
                </x-form.radio-button>
            </div>
            <div class="col-md-3 my-10">
                <x-form.label class="font-bold">Role</x-form.label>
                <x-form.radio-button>
                    <x-slot name="label1">
                        <input type="radio" wire:model="role" id="customRadio4" name="role"
                            class="custom-control-input" value="{{ \App\Enums\Role::User->value }}">
                        <label class="custom-control-label" for="customRadio4">User</label>
                    </x-slot>
                    <x-slot name="label2">
                        <input type="radio" wire:model="role" id="customRadio3" name="role"
                            class="custom-control-input" value="{{ \App\Enums\Role::Admin->value }}">
                        <label class="custom-control-label" for="customRadio3">Admin</label>
                    </x-slot>
                </x-form.radio-button>
            </div>
            <div class="col-md-6 my-10">

                <div class="custom-file">
                    <input type="file" class="custom-file-input" wire:model.defer="image">
                    <label class="custom-file-label">Choose Image</label>
                </div>

                @if ($image)
                    <img src="{{ $image->temporaryUrl() }}" alt="image" class="imageList my-10 ">
                @else
                <img src="{{ asset('assets/images/static') }}/1660910188_user.png"
                class="imageList my-10" style="padding: 20px;" alt="">
                @endif
                @error('image')
                    <p class="text-danger ">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <x-form.button class="float-right" wire:click="save" :error="$errors">
            Save
        </x-form.button>
    </fieldset>
</div>
