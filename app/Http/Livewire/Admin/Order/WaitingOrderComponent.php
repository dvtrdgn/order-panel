<?php

namespace App\Http\Livewire\Admin\Order;

use App\Models\Dealer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class WaitingOrderComponent extends Component
{
    public $search;
    public $selected_product;
    public $order_count = [];
    public $deleted_order_id;
    public $dealerList = [];
    public $all_orders;
    public $dealerId;
    public $completedOrder = null;

    public function mount()
    {
        $this->getAllDealerId();
        $this->allOrders();
    }

    public function allOrders()
    {
        $this->all_orders = Order::search($this->search)
            ->whereIn('dealer_id',  $this->dealerList)
            ->where('isCompleted', 0)
            ->where('isDealerCompleteOrder', 1)
            ->orderBy('category_id', 'DESC')
            ->get()->toArray();
    }

    public function updatedSearch()
    {
        $this->allOrders();
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

        $this->allOrders();
    }

    public function confirmCompleteOrder($order_id)
    {
        $this->completedOrder = null;
        $this->completedOrder = Order::where('id', $order_id)->first();
    }

    public function completeOrder()
    {
        $findProduct = Product::where('id', $this->completedOrder->product_id)->first();
        $findOrder = Order::where('id', $this->completedOrder->id)->first();
        $updatedProductStockCount = $findProduct->quantity - $findOrder->quantity;
        if ($findProduct->quantity >= $findOrder->quantity) {
            $res = Order::where('id', $this->completedOrder->id)->update(['isCompleted' => 1, 'ordered_user_id' => Auth::user()->id]);
            Product::where('id', $findProduct->id)->update(['quantity' => $updatedProductStockCount]);

            $this->allOrders();

            if ($res) {
                $this->dispatchBrowserEvent(
                    'alert',
                    ['type' => 'success',  'message' => __($this->completedOrder->product->title . "'s order completed successfully")]
                );
            }
        } else {
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'warning',  'message' => __($findProduct->title . "'s stock quantity is not enough ")]
            );
        }
    }


    public function allCompleteOrder()
    {
        foreach ($this->all_orders as  $order) {
            $findProduct = Product::where('id', $order['product_id'])->first();
            $updatedProductStockCount = $findProduct->quantity - $order['quantity'];
            if ($findProduct->quantity >= $order['quantity']) {
                Order::where('id', $order['id'])->update(['isCompleted' => 1, 'ordered_user_id' => Auth::user()->id]);
                Product::where('id', $order['product_id'])->update(['quantity' => $updatedProductStockCount]);
            } else {
                $this->dispatchBrowserEvent(
                    'alert',
                    ['type' => 'warning',  'message' => __($findProduct->title . "'s stock quantity is not enough ")]
                );
            }
        }
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success',  'message' => "All orders completed successfully"]
        );

        $this->allOrders();
    }
    public function undoCompleteOrder()
    {
        $allOrder = Order::get();
        foreach ($allOrder as  $order) {
            Order::where('id', $order['id'])->update(['isCompleted' => 0]);
            Order::where('id', $order['id'])->update(['ordered_user_id' => null]);
        }
        $this->allOrders();
    }

    public function saveOrder($index, $order_id)
    {
        if (isset($this->order_count[$index])) {
            if ($this->order_count[$index] < 1) {
                return $this->dispatchBrowserEvent(
                    'alert',
                    ['type' => 'warning',  'message' => __('Quantity should be at least 1.')]
                );
            }
            if ($this->order_count[$index] > 250) {
                return $this->dispatchBrowserEvent(
                    'alert',
                    ['type' => 'warning',  'message' => __('Quantity should not be more than 250.')]
                );
            }
            $check_order_new = Order::where('id', $order_id)
                ->where('isCompleted', 0)->first();

            if ($check_order_new) {
                $check_order_new->quantity = $this->order_count[$index];
                $check_order_new->ordered_user_id = Auth::user()->id;

                if ($check_order_new->isDirty()) {
                    $check_order_new->save();
                }
            }
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success',  'message' => __('Quantity updated!')]
            );
        } else {
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'warning',  'message' => __('Add count!')]
            );
        }
        $this->order_count[$index] = null;
        $this->allOrders();
    }

    public function confirmDelete($order_id)
    {
        $this->deleted_order_id = $order_id;
    }

    public function cancelOrder()
    {
        $deleted_id = $this->deleted_order_id;
        $res = Order::where('id', $deleted_id)->where('isCompleted', 0)->first()->delete();
        if ($res) {
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success',  'message' => __('Order deleted!')]
            );
        }
        $this->deleted_order_id = null;
        $this->allOrders();
    }

    public function PDFList()
    {
        $this->allOrdersForPDF = Order::search($this->search)
            ->whereIn('dealer_id',  $this->dealerList)
            ->where('isCompleted', 0)
            ->where('isDealerCompleteOrder', 1)
            ->orderBy('category_id', 'DESC')
            ->get();

        $getDealer = Dealer::find($this->dealerId);
        $dealerName =  Str::slug($getDealer->name, '_');
        $date = Str::slug(now()->format('Y-m-d H:i'), '_');
        Pdf::setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdfContent = PDF::loadView('livewire.p-d-f.order-report', ['data' => $this->allOrdersForPDF, 'siteSetting' => Setting::where('id', 1)->first()])->output();
        return response()->streamDownload(
            fn () => print($pdfContent),
            "$dealerName----order-request-----$date.pdf"
        );
    }
    public function render()
    {
        return view('livewire.admin.order.waiting-order-component', ['dealers' => Dealer::all()]);
    }
}
