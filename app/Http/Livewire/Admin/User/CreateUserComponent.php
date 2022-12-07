<?php

namespace App\Http\Livewire\Admin\User;

use App\Enums\Role;
use App\Enums\Status;
use App\Models\Dealer;
use App\Models\User;
use App\Repository\User\UserRepo;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Livewire\WithFileUploads;

class CreateUserComponent extends Component
{
    use WithFileUploads;
    public $user;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $status;
    public $role;
    public $image;
    public $dealer_id;

    // set validation rules
    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed',
        'image' => 'max:2000',
        'dealer_id' => 'required'
    ];
      // customize validation message
      protected $messages = [
        'dealer_id' => 'Dealer is required',

    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();
        $this->password = FacadesHash::make($this->password);
        if ($this->image) {
            $image_url = Carbon::now()->timestamp . '_user.' . $this->image->extension();
            $this->image->storeAs('user',  $image_url);
        }

        $result =  User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'status' => $this->status,
            'role' => $this->role,
            'dealer_id' => $this->dealer_id,
            'profile_photo_path' => $this->image_url ?? null,
        ]);

        if ($result) {
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success',  'message' => 'New user created successfully!']
            );
        }
        // $this->name = null;
        // $this->email = null;
        // $this->password = null;
        // $this->image = null;
        // $this->dealer_id = null;
        // $this->password_confirmation = null;
        $this->reset();
        $this->status = Status::Active->value;
        $this->role = Role::User->value;
    }

    public function mount()
    {
        // initialize model
        $this->user =  new User();
        $this->status = Status::Active->value;
        $this->role = Role::User->value;
    }

    public function render()
    {
        return view('livewire.admin.user.create-user-component', ['dealers' => Dealer::all()]);
    }
}
