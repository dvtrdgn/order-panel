<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DealerController extends Controller
{

    public function index()
    {
        return view('admin.dealer.index-dealer');
    }

    public function create()
    {
       return view('admin.dealer.create-dealer');
    }

    public function edit($id)
    {
        return view('admin.dealer.edit-dealer', ['dealer_id'=>$id]);
    }

}
