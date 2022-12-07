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
        'updatedProduct.category_id'=>'',
        'updatedProduct.image'=>'',
        'updatedProduct.order'=>'',
        'updatedProduct.status'=>'',
        'updatedProduct.description'=>'',
        'updatedProduct.barcode'=>'',
        'updatedProduct.material'=>'',
        'updatedProduct.size'=>'',
        'updatedProduct.background_color'=>'',
        'updatedProduct.description_for_worker'=>'',
        'updatedProduct.keywords_for_search'=>'',
        'updatedProduct.quantity'=>'',
        'updatedProduct.alert_min_count'=>'',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function mount($product_id)
    {
        $this->product_id = $product_id;

        $this->updatedProduct = Product::where('id', $product_id)->first();

        // $this->category_id = $updatedProduct->category_id;
        // $this->product_id = $updatedProduct->id;
        // $this->title = $updatedProduct->title;
        // $this->order = $updatedProduct->order;
        // $this->isActive = $updatedProduct->isActive;
        // $this->description = $updatedProduct->description;
        // $this->image = $updatedProduct->image;
        // $this->barcode = $updatedProduct->barcode;
        // $this->material = $updatedProduct->material;
        // $this->size = $updatedProduct->size;
        // $this->background_color = $updatedProduct->background_color;
        // $this->description_for_worker = $updatedProduct->description_for_worker;
        // $this->keywords_for_search = $updatedProduct->keywords_for_search;
        // $this->quantity = $updatedProduct->quantity;
        // $this->alert_min_count = $updatedProduct->alert_min_count;

        $this->all_Categories  = Category::with('children')->orderBy('parent_id', 'ASC')->get();
    }



    public function save()
    {
        $this->validate();

        // $updated_product =  Product::where('id', $this->product_id)->first();


        // $updated_product->title = $this->title;
        // $updated_product->isActive = $this->isActive;
        // $updated_product->order = $this->order;
        // $updated_product->description = $this->description;
        // $updated_product->category_id = $this->category_id;


        // $updated_product->barcode = $this->barcode;
        // $updated_product->material = $this->material;
        // $updated_product->size = $this->size;
        // $updated_product->background_color = $this->background_color;
        // $updated_product->description_for_worker = $this->description_for_worker;
        // $updated_product->keywords_for_search = $this->keywords_for_search;
        // $updated_product->quantity = $this->quantity;
        // $updated_product->alert_min_count = $this->alert_min_count;

        if ($this->new_image) {
            $imagePath = "/product/" . $this->updatedProduct->image;
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
            $imageName1 = Carbon::now()->timestamp . '_product.' . $this->new_image->extension();
            $this->new_image->storeAs('product', $imageName1);
            $this->updatedProduct->image = $imageName1;
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
