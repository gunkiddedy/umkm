<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{

    public function companyPage($id)
    {
        return view('company');
    }

    public function companyList()
    {
        return view('company-list');
    }

    public function productDetail($id)
    {        
        return view('product-detail');
    }
}
