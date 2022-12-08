<?php

namespace App\Http\Livewire\Admin\Dealer;

use App\Models\Dealer;
use App\Models\Orderlist;
use Livewire\Component;
use Livewire\WithPagination;

class OrderListComponent extends Component
{
    use WithPagination;

    public $selectedDealer;
    public $dateFrom;
    public $dateTo;
    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'dateFrom' => 'required|date',
        'dateTo' => 'required|date|after_or_equal:dateFrom',
    ];

    public function query()
    {
        $this->validate();
        $this->resetPage();
    }

    public function clearDates()
    {
        $this->dateFrom = null;
        $this->dateTo = null;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount($dealer_id)
    {
        $this->selectedDealer = Dealer::find($dealer_id);
    }
    public function render()
    {
        return view(
            'livewire.admin.dealer.order-list-component',
            ['completedOrders' => Orderlist::search($this->dateFrom, $this->dateTo)->where('dealer_id', $this->selectedDealer->id)->orderBy('created_at', 'desc')->Paginate(Orderlist::PAGINATION_COUNT)]
        );
    }
}
