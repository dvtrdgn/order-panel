<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class ListProductComponent extends Component
{
    use WithPagination;

    public $search;
    public $get_product;
    public $deleteId = null;
    public $order_quantity;
    public $orderedProductIndex;
    public $check_product_order;
    public $check_product_order_count;
    public $productCount;
    protected $paginationTheme = 'bootstrap';

    public function deleteId($id)
    {
        $this->deleteId = $id;
        $this->check_product_order = Order::Where('product_id', $id)->where('isCompleted', 0)->get();
        $this->check_product_order_count = Order::Where('product_id', $id)->where('isCompleted', 0)->count();
    }

    public function delete()
    {
        $get_data = Product::find($this->deleteId);
        $imagePath = "/product/" . $get_data->image;
        if (Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }
        $result =   Product::destroy($this->deleteId);
        if ($result) {
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success',  'message' => 'User deleted!']
            );
        }
    }

    public function mount()
    {
        $this->productCount = Product::count();
    }
    public function render()
    {
        return view('livewire.admin.product.list-product-component', ['products' => Product::search($this->search)->orderBy('id', 'DESC')->Paginate(Product::PAGINATION_COUNT)]);
    }
}
