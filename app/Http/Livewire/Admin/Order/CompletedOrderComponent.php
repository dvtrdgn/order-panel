<?php

namespace App\Http\Livewire\Admin\Order;

use App\Models\Category;
use App\Models\Dealer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CompletedOrderComponent extends Component
{
    use WithPagination;

    public $search;
    public $dealerId;
    public $dealerList = [];
    public $retrieveOrder;
    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }    

    public function mount()
    {
        if ($this->dealerId == null) {
            $this->getAllDealerId();
        } else {
            $this->dealerList = [];
            $this->dealerList[] = $this->dealerId;
        }
    }

    public function getAllDealerId()
    {
        $allDealer = Dealer::all();
        foreach ($allDealer as  $value) {
            $this->dealerList[] = $value->id;
        }
    }

    public function updatedDealerId()
    {
        if ($this->dealerId == null) {
            $this->getAllDealerId();
        } else {
            $this->dealerList = [];
            $this->dealerList[] = $this->dealerId;
        }
    }

    public function confirmRetrieveOrder($order_id)
    {
        $this->retrieveOrder = null;
        $this->retrieveOrder = Order::where('id', $order_id)->first();
    }

    public function retrieveOrder()
    {
        $findProduct = Product::where('id', $this->retrieveOrder->product_id)->first();
        $findOrder = Order::where('id', $this->retrieveOrder->id)->first();
        $updatedProductStockCount = $findProduct->quantity + $findOrder->quantity;
        $res =  Order::where('id', $this->retrieveOrder->id)->update(['isCompleted' => 0, 'ordered_user_id' => Auth::user()->id]);
        Product::where('id', $this->retrieveOrder->product_id)->update(['quantity' => $updatedProductStockCount]);
        if ($res) {
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success',  'message' => __($this->retrieveOrder->product->title . ' is retrieved successfully')]
            );
        }
    }

    public function confirmDelete($order_id)
    {
        $this->deleted_order_id = $order_id;
    }

    public function cancelOrder()
    {
        $deleted_id = $this->deleted_order_id;
        $res = Order::where('id', $deleted_id)->where('isCompleted', 1)->first()->delete();
        if ($res) {
            $this->emit('alert', ['type' => 'success', 'message' => __('success')]);
        }
        $this->deleted_order_id = null;
    }

    public function render()
    {
        return view('livewire.admin.order.completed-order-component', ['completedOrders' => Order::search($this->search)->orderBy('created_at', 'asc')->where('isCompleted', 1)->where('isDealerCompleteOrder', 1)->whereIn('dealer_id', $this->dealerList)->Paginate(Order::PAGINATION_COUNT), 'dealers' => Dealer::all()]);
    }
}
