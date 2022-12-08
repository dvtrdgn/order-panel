<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\Dealer;
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

    protected function rules()
    {
        return [
            'user.name' => 'required|min:3',
            'user.email' => 'required|string|email|max:255|unique:users,email,' . $this->user_id,
            'user.profile_photo_path' => 'max:2000',
            'user.status' => '',
            'user.role' => '',
            'user.dealer_id' => 'required',
        ];
    }

    protected $messages = [
        'user.dealer_id' => 'Dealer is required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();
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
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success',  'message' => 'User updated successfully!']
            );
        } else {
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'warning',  'message' => 'No new data to update!']
            );
        }
    }

    public function mount($user_id)
    {
        $this->user_id = $user_id;
        $this->user = User::find($this->user_id);
    }

    public function render()
    {
        return view('livewire.admin.user.edit-user-component', ['dealers' => Dealer::all()]);
    }
}
