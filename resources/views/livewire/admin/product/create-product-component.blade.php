<fieldset class="form-fieldset mg-10 shadow-md hover:shadow-xl col-md-12">
    <legend>Product Information</legend>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 margin-bottom-10">
                <div class="card  box-shadow-0">
                    <div class="card-body">
                        <div class="form-group ">
                            <label class="form-label">Product Category </label>
                            <select wire:model="category_id" name="category_id" class="form-control">
                                <option>Select Category</option>
                                @foreach ($all_Categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ \App\Models\Category::getParentsTree($category, $category->title) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-danger mt-3">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <x-form.input wire:model="title" :error="$errors->first('title')">Product Title</x-form.input>
                        </div>
                        <div class="form-group">
                            <x-form.input wire:model="barcode" :error="$errors->first('barcode')">Barcode</x-form.input>
                        </div>
                        <div class="form-group">
                            <x-form.input wire:model="material" :error="$errors->first('material')">Material</x-form.input>
                        </div>
                        <div class="form-group">
                            <x-form.input wire:model="background_color" :error="$errors->first('background_color')">Background color
                            </x-form.input>
                        </div>
                        <div class="form-group">
                            <x-form.input wire:model="size" :error="$errors->first('size')">Size</x-form.input>
                        </div>
                        <div class="form-group">
                            <x-form.label>Description</x-form.label>
                            <x-form.textarea wire:model.lazy="description" :error="$errors->first('description')">{{ $description }}
                            </x-form.textarea>
                        </div>
                        <div class="form-group">
                            <x-form.label>Description for worker</x-form.label>
                            <x-form.textarea wire:model.lazy="description_for_worker" :error="$errors->first('description_for_worker')">
                                {{ $description_for_worker }}
                            </x-form.textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card margin-bottom-10">
                    <div class="card-body">
                        <div class="row" x-data="{ isUploading: false, progress: 5 }" x-on:livewire-upload-start="isUploading=true"
                            x-on:livewire-upload-finish="isUploading=false, progress=5"
                            x-on:livewire-upload-error="isUploading=false"
                            x-on:livewire-upload-progress="progress=$event.detail.progress">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <div class="custom-file">
                                        <x-form.image-upload wire:model="image" :error="$errors->first('image')"></x-form.image-upload>
                                    </div>
                                    <div class="progress my-3" x-show.transition="isUploading">
                                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                                            x-bind:style="`width: ${progress}%`" aria-valuenow="25" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-auto">
                                @if ($image)
                                    <img src="{{ $image->temporaryUrl() }}" alt="image" class="imageList my-3">
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <x-form.input type="number" wire:model="quantity" :error="$errors->first('quantity')">Quantity</x-form.input>
                        </div>
                        <div class="form-group">
                            <x-form.input type="number" wire:model="alert_min_count" :error="$errors->first('alert_min_count')">Alert for
                                minimum quantity</x-form.input>
                        </div>
                        <div class="form-group">
                            <x-form.input type="number" wire:model="order" :error="$errors->first('order')">Order</x-form.input>
                        </div>
                        <div class="form-group">
                            <x-form.label>Keywords for search</x-form.label>
                            <x-form.textarea wire:model.lazy="keywords_for_search" :error="$errors->first('keywords_for_search')">
                                {{ $keywords_for_search }}
                            </x-form.textarea>
                        </div>
                        <div class="card panel-theme margin-bottom-10">
                            <div class="card-body no-padding">
                                <x-form.label class="font-bold">Status</x-form.label>
                                <x-form.radio-button>
                                    <x-slot name="label1">
                                        <input type="radio" wire:model="status" id="customRadio1" name="status"
                                            class="custom-control-input" value="{{ \App\Enums\Status::Active->value }}">
                                        <label class="custom-control-label" for="customRadio1">Active</label>
                                    </x-slot>
                                    <x-slot name="label2">
                                        <input type="radio" wire:model="status" id="customRadio2" name="status"
                                            class="custom-control-input"
                                            value="{{ \App\Enums\Status::Passive->value }}">
                                        <label class="custom-control-label" for="customRadio2">Passive</label>
                                    </x-slot>
                                </x-form.radio-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-form.button class="float-right my-3" wire:click="save" :error="$errors">
        Save
    </x-form.button>
</fieldset>
