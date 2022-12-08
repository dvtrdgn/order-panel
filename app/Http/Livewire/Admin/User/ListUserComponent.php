<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\Order;
use App\Models\User;
use App\Repository\User\UserRepo;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class ListUserComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;
    public $deleteId;
    public $canDelete;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function deleteId($id)
    {
        $this->canDelete = 0;
        $this->deleteId = $id;
        $checkOrderBySelectedUser = Order::where('user_id', $this->deleteId)->orWhere('ordered_user_id', $this->deleteId)->first();

        if ($checkOrderBySelectedUser) {
            $this->canDelete =0;
        } else {
            $this->canDelete =1;
        }       
    }

    public function delete()
    {
        $get_user = User::find($this->deleteId);
        $imagePath = "/user/" . $get_user->profile_photo_path;
        if (Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }
        $result =   User::destroy($this->deleteId);

        if ($result) {
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success',  'message' => 'User deleted!']
            );
        }
    }

    public function render()
    {
        return view('livewire.admin.user.list-user-component', ['users' => User::search($this->search)->orderBy('id', 'DESC')->Paginate(User::PAGINATION_COUNT)]);
    }
}
