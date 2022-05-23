<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    function form_product(){
        return view('product.add_product');
    }
}
