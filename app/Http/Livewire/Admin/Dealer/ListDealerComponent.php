<?php

namespace App\Http\Livewire\Admin\Dealer;

use App\Models\Dealer;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class ListDealerComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;
    public $deleteId;
    public $canDelete;
    public $getDealer;
    public $hasUser = 0;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function deleteId($id)
    {
        $this->hasUser = 0;
        $this->deleteId = $id;
        $this->getDealer = Dealer::find($this->deleteId);
        if ($this->getDealer->users->count()) {
            $this->hasUser = 1;
        }
    }

    public function delete()
    {
        $getData = Dealer::find($this->deleteId);
        $imagePath = "/dealer/" . $getData->image;
        if (Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }

        $result =   Dealer::destroy($this->deleteId);

        if ($result) {
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success',  'message' => 'Dealer deleted successfully!']
            );
        }
    }

    public function render()
    {
        return view('livewire.admin.dealer.list-dealer-component', ['dealers' => Dealer::search($this->search)->orderBy('id', 'DESC')->Paginate(Dealer::PAGINATION_COUNT)]);
    }
}
