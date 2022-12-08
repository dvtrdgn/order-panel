<?php

namespace App\Http\Livewire\Admin;

use App\Models\Dealer;
use Livewire\Component;

class DashboardComponent extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard-component', ['dealers'=>Dealer::all()]);
    }
}
