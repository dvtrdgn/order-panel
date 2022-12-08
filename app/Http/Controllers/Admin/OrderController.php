<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function waitingOrder()
    {
        return view('admin.order.waiting-order');
    }
    public function completedOrder()
    {
        return view('admin.order.completed-order');
    }
}
