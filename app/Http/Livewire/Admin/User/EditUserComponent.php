<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use App\Repository\User\UserRepo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditUserComponent extends Component
{
    use WithFileUploads;
    public $user_id;
    public User $user;
    public $new_image;


    // set validation rules
    protected $rules = [
        'user.name' => 'required|min:3',
        'user.email' => 'required|email|unique:users',
        'user.profile_photo_path' => 'max:2000',
        'user.status' => '',
        'user.role' => '',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        if ($this->new_image) {            
            $imagePath = "/user/" . $this->user->profile_photo_path;
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
            $imagePath = Carbon::now()->timestamp . '_user.' . $this->new_image->extension();
            $this->new_image->storeAs('user', $imagePath);
            
            $this->user->profile_photo_path = $imagePath;
        }

        if ($this->user->isDirty()) {
            $this->user->save();
        }
    }


    public function mount($user_id)
    {
        $this->user_id = $user_id;
        $this->user = User::find($this->user_id);
    }

    public function render()
    {
        return view('livewire.admin.user.edit-user-component');
    }
}
