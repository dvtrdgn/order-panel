<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        return view('admin.category.index-category');
    }

    public function create()
    {
        return view('admin.category.create-category');
    }

    public function edit($id)
    {
        return view('admin.category.edit-category', ['category_id'=>$id]);
    }
}
