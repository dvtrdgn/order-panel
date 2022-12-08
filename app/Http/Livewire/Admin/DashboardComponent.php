<?php

namespace App\Http\Livewire\Admin;

use App\Enums\Status;
use App\Models\Dealer;
use App\Models\Product;
use Livewire\Component;

class DashboardComponent extends Component
{
    public $allProductWithAlertStock;
    public $productId = [];
    public $AllProductName = [];
    public $AllProductQuantity=[];

    public function mount()
    {
        $allProduct = Product::where('status', Status::Active->value)->whereNotNull('quantity')->get();
        if ($allProduct) {
            foreach ($allProduct as $key => $product) {
                if ($product->quantity < $product->alert_min_count) {
                    $this->productId[] = $product->id;
                }
            }
        }
        $this->allProductWithAlertStock = Product::where('status', Status::Active->value)->whereIn('id', $this->productId)->get();

        $productLessThan500 = Product::where('status', Status::Active->value)->orderBy('quantity', 'ASC')->where('quantity', '<', 500)->get();

        if ($productLessThan500) {
           foreach ($productLessThan500 as  $product) {
            $this->AllProductName[] = $product->title;
            $this->AllProductQuantity[] = $product->quantity;
        }
        }    
    }

    public function render()
    {
        return view('livewire.admin.dashboard-component', ['dealers' => Dealer::all()]);
    }
}
