<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        return view('admin.user.index-user');
    }

    public function create()
    {
        return view('admin.user.create-user');
    }

    public function edit($id)
    {
        return view('admin.user.edit-user', ['user_id' => $id]);
    }
}
