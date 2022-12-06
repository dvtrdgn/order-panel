    <fieldset class="form-fieldset mg-10 shadow-md hover:shadow-xl col-md-12">
        <legend>Dealer Information</legend>
        <div class="row">
            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 margin-bottom-10">
                <div class="card  box-shadow-0">
                    <div class="card-body">
                        <div class="form-group">
                            <x-form.input wire:model="dealer.name" :error="$errors->first('dealer.name')">Name</x-form.input>
                        </div>
                        <div class="form-group">
                            <x-form.input wire:model="dealer.email" :error="$errors->first('dealer.email')">Email</x-form.input>
                        </div>
                        <div class="form-group">
                            <x-form.input wire:model="dealer.phone" :error="$errors->first('dealer.phone')">Phone Number</x-form.input>
                        </div>
                        <div class="form-group">
                            <x-form.label>Description</x-form.label>
                            <x-form.textarea wire:model.lazy="dealer.description" :error="$errors->first('dealer.description')">{{ $dealer->description }}
                            </x-form.textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card margin-bottom-10">
                    <div class="card-body">
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
                                <img class="imageList p-3 my-3" src="{{ asset('assets/images/dealer') }}/{{ $dealer->image }}" alt="">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card panel-theme" style="margin-bottom: 10px;">
                    <div class="card-header">
                        <div class="form-group">
                            <div class="form-group">
                                <x-form.input type="number" wire:model="dealer.order" :error="$errors->first('dealer.order')">Order</x-form.input>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="card panel-theme">
                    <div class="card-body no-padding">
                        <x-form.label class="font-bold">Status</x-form.label>
                        <x-form.radio-button>
                            <x-slot name="label1">
                                <input type="radio" wire:model="dealer.status" id="customRadio1" name="status" class="custom-control-input" value="{{ \App\Enums\Status::Active->value }}">
                                <label class="custom-control-label" for="customRadio1">Active</label>
                            </x-slot>
                            <x-slot name="label2">
                                <input type="radio" wire:model="dealer.status" id="customRadio2" name="status" class="custom-control-input" value="{{ \App\Enums\Status::Passive->value }}">
                                <label class="custom-control-label" for="customRadio2">Passive</label>
                            </x-slot>
                        </x-form.radio-button>
                    </div>
                </div>
            </div>
        </div>
        <x-form.button class="float-right my-3" wire:click="save" :error="$errors">
            Save
        </x-form.button>
    </fieldset>
