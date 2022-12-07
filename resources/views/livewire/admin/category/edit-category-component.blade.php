<fieldset class="form-fieldset mg-10 shadow-md hover:shadow-xl col-md-12">
    <legend>Category Information</legend>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 margin-bottom-10">
                <div class="card  box-shadow-0">
                    <div class="card-body">
                        <div class="form-group ">
                            <label class="form-label">Parent Category <span class="text-red">*</span></label>
                            <select wire:model="parent_id" name="parent_id" class="form-control">
                                <option value=0>Parent Category</option>
                                @foreach ($allCategories as $category)
                                <option value="{{ $category->id }}">
                                    {{\App\Models\Category::getParentsTree($category, $category->title) }}
                                </option>
                                @endforeach
                            </select>
                            @error('parent_id')
                            <p class="text-danger my-3">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <x-form.input wire:model="title" :error="$errors->first('title')">Name</x-form.input>
                        </div>
                        <div class="form-group">
                            <x-form.label>Description</x-form.label>
                            <x-form.textarea wire:model.lazy="description" :error="$errors->first('description')">{{ $description }}
                            </x-form.textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card margin-bottom-10">
                    <div class="card-body">
                        <div class="row">                          
                            <div class="col-12 my-auto mt-auto">
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
                                        <div class="col-12 mt-auto">
                                            @if ($new_image)
                                            <img class="imageList p-3 my-3" src="{{ $new_image->temporaryUrl() }}" alt="image">
                                            @else
                                            <img class="imageList p-3 my-3" src="{{ asset('assets/images/category') }}/{{ $category->image }}" alt="">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card panel-theme" style="margin-bottom: 10px;">
                    <div class="card-header">
                       <div class="form-group">
                           <x-form.input type="number" wire:model="order" :error="$errors->first('order')">Order</x-form.input>
                       </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="card panel-theme">
                    <div class="card-body no-padding">
                        <x-form.label class="font-bold">Status</x-form.label>
                        <x-form.radio-button>
                            <x-slot name="label1">
                                <input type="radio" wire:model="status" id="customRadio1" name="status" class="custom-control-input" value="{{ \App\Enums\Status::Active->value }}">
                                <label class="custom-control-label" for="customRadio1">Active</label>
                            </x-slot>
                            <x-slot name="label2">
                                <input type="radio" wire:model="status" id="customRadio2" name="status" class="custom-control-input" value="{{ \App\Enums\Status::Passive->value }}">
                                <label class="custom-control-label" for="customRadio2">Passive</label>
                            </x-slot>
                        </x-form.radio-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-form.button class="float-right my-3" wire:click="save" :error="$errors">
        Save
    </x-form.button>
</fieldset>

