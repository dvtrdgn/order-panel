<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{   
    public function index()
    {
        return view('admin.product.index-product');
    }

     public function create()
    {
        return view('admin.product.create-product');
    }

     public function edit($id)
    {
        return view('admin.product.edit-product', ['product_id'=>$id]);
    }


}
