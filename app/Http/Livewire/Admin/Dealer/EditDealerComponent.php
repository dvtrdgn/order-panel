<?php

namespace App\Http\Livewire\Admin\Dealer;

use App\Models\Dealer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditDealerComponent extends Component
{
    use WithFileUploads;
    public $dealer_id;
    public Dealer $dealer;
    public $new_image;


    protected function rules()
    {
        return [
            'dealer.name' => 'required|min:3',
            'dealer.email' => 'required|string|email|max:255|unique:dealers,email,' . $this->dealer_id,
            'dealer.image' => 'max:2000',
            'dealer.status' => '',
            'dealer.description' => '',
            'dealer.phone' => '',
            'dealer.order' => '',

        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
         $this->validate();
        if ($this->new_image) {
            $imagePath = "/dealer/" . $this->dealer->image;
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
            $imagePath = Carbon::now()->timestamp . '_dealer.' . $this->new_image->extension();
            $this->new_image->storeAs('dealer', $imagePath);

            $this->dealer->image = $imagePath;
        }

        if ($this->dealer->isDirty()) {
            $this->dealer->save();
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success',  'message' => 'Dealer updated successfully!']
            );
        } else {
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'warning',  'message' => 'No new data to update!']
            );
        }
    }

    public function mount($dealer_id)
    {
        $this->dealer_id = $dealer_id;
        $this->dealer = Dealer::find($this->dealer_id);
    }


    public function render()
    {
        return view('livewire.admin.dealer.edit-dealer-component');
    }
}
