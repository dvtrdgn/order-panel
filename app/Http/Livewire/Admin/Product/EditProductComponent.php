<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditProductComponent extends Component
{
    use WithFileUploads;

    public  $new_image;
    public $product_id;
    public $all_Categories;
    public  $updatedProduct;

    protected $rules = [
        'updatedProduct.title' => 'required',
        'updatedProduct.alert_min_count' => 'required',
        'updatedProduct.quantity' => 'required',
        'new_image' => 'max:2000',
        'updatedProduct.category_id' => '',
        'updatedProduct.image' => '',
        'updatedProduct.order' => '',
        'updatedProduct.status' => '',
        'updatedProduct.description' => '',
        'updatedProduct.barcode' => '',
        'updatedProduct.material' => '',
        'updatedProduct.size' => '',
        'updatedProduct.background_color' => '',
        'updatedProduct.description_for_worker' => '',
        'updatedProduct.keywords_for_search' => '',
        'updatedProduct.quantity' => '',
        'updatedProduct.alert_min_count' => '',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount($product_id)
    {
        $this->product_id = $product_id;
        $this->updatedProduct = Product::where('id', $product_id)->first();
        $this->all_Categories  = Category::with('children')->orderBy('parent_id', 'ASC')->get();
    }

    public function save()
    {
        $this->validate();
        if ($this->new_image) {
            $imagePath = "/product/" . $this->updatedProduct->image;
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
            $imageName = Carbon::now()->timestamp . '_product.' . $this->new_image->extension();
            $this->new_image->storeAs('product', $imageName);
            $this->updatedProduct->image = $imageName;
            $this->updatedProductimage = $this->updatedProduct->image;
        }
        if ($this->updatedProduct->isDirty()) {
            $this->updatedProduct->save();
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success',  'message' => 'Product updated successfully!']
            );
        } else {
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'warning',  'message' => 'No new data to update!']
            );
        }
    }
    public function render()
    {
        return view('livewire.admin.product.edit-product-component');
    }
}
