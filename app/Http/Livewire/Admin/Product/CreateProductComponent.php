<?php

namespace App\Http\Livewire\Admin\Product;

use App\Enums\Status;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateProductComponent extends Component
{
    use WithFileUploads;

    public $title;
    public $image;
    public $order;
    public $status;
    public $description;
    public $parent_id;
    public $all_Categories;
    public $category_id;
    public $barcode;
    public $material;
    public $size;
    public $background_color;
    public $description_for_worker;
    public $keywords_for_search;
    public $quantity;
    public $alert_min_count;

    protected $rules = [
        'title' => 'required',
        'category_id' => 'required',
        'alert_min_count' => 'required',
        'quantity' => 'required',
        'image' => 'max:2000'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();
        $product =  new Product();
        $product->category_id = $this->category_id;
        $product->title = $this->title;
        $product->status = $this->status;
        $product->order = $this->order;
        $product->description = $this->description;
        $product->barcode = $this->barcode;
        $product->material = $this->material;
        $product->size = $this->size;
        $product->background_color = $this->background_color;
        $product->description_for_worker = $this->description_for_worker;
        $product->keywords_for_search = $this->keywords_for_search;
        $product->quantity = $this->quantity;
        $product->alert_min_count = $this->alert_min_count;

        if ($this->image) {
            $image = Carbon::now()->timestamp . '_product.' . $this->image->extension();
            $this->image->storeAs('product', $image);
            $product->image = $image;
        }

        if ($product->isDirty()) {
            $product->save();
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success',  'message' => 'User updated successfully!']
            );
        }

        $this->title = null;
        $this->image = null;
        $this->order = null;
        $this->description = null;
        $this->category_id = null;
        $this->barcode = null;
        $this->material = null;
        $this->size = null;
        $this->background_color = null;
        $this->description_for_worker = null;
        $this->keywords_for_search = null;
        $this->quantity = null;
    }

    public function mount()
    {
        $this->all_Categories = Category::with('children')->orderBy('title', 'ASC')->get();
        $this->status = Status::Active->value;
    }
    public function render()
    {
        return view('livewire.admin.product.create-product-component');
    }
}
