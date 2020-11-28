<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Product;
use App\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function companyList()
    {
        $companies = User::withFilters()->where([
                ['role', '=', 'member'],
                ['is_blacklist', '=', 0]
            ])->orderBy('id', 'desc')->paginate(4);
                
        return response()->json($companies);
    }

    public function userBlacklist()
    {   
        $users = User::withFilters()->where([
            ['role', '=', 'member'],
            ['is_blacklist', '=', 1]
        ])->orderBy('id', 'desc')->paginate(4);

        return response()->json($users);
    }

    public function productList()
    {
        $products = Product::withFilters()->orderBy('is_active')->paginate(5);

        return response()->json($products);
    }

    public function approvingProduct($id)
    {
        $product = Product::find($id);
        $product->is_active = 1;
        $product->save();
        
        return response()->json('product successfuly updated');
    }

    public function setUserActive($id)
    {
        $user = User::find($id);
        $user->is_active = 1;
        $user->is_blacklist = 0;
        $user->save();
        
        return response()->json('user successfuly activated');
    }

    public function setUserInActive($id)
    {
        $user = User::find($id);
        $user->is_active = 0;
        $user->is_blacklist = 1;
        $user->save();
        
        return response()->json('user successfuly disabled');
    }

    public function productListDetailImage($id)
    {
        $images = ProductImage::where('product_id', $id)->with('product')->get();
        
        return response()->json([
            'images' => $images,
        ]);
    }

    public function companyRequest()
    {
        $request = User::where([
            ['is_active', '=', 0],
            ['is_blacklist', '=', 0]
        ])->count();
        
        return response()->json($request);
    }

    public function productRequest()
    {
        $request = Product::where('is_active', 0)->count();
        
        return response()->json($request);
    }
    
    public function blacklistRequest()
    {
        $request = User::where([
            ['is_active', '=', 0],
            ['is_blacklist', '=', 1]
        ])->count();
        
        return response()->json($request);
    }

}
