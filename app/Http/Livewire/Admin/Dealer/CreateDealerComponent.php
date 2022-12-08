<?php

namespace App\Http\Livewire\Admin\Dealer;

use App\Enums\Status;
use App\Models\Dealer;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateDealerComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $email;
    public $image;
    public $status;
    public $description;
    public $phone;
    public $order;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();
        if ($this->image) {
            $image_url = Carbon::now()->timestamp . '_dealer.' . $this->image->extension();
            $this->image->storeAs('dealer',  $image_url);
        }

        $result =  Dealer::create([
            'name' => $this->name,
            'email' => $this->email,
            'status' => $this->status,
            'description' => $this->description,
            'phone' => $this->phone,
            'order' => $this->order,
            'image' => $this->image_url ?? null,
        ]);

        if ($result) {
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success',  'message' => 'New dealer created successfully!']
            );
        }

        $this->reset();
        $this->status = Status::Active->value;
    }
    public function mount()
    {
        $this->status = Status::Active->value;
    }

    public function render()
    {
        return view('livewire.admin.dealer.create-dealer-component');
    }
}
