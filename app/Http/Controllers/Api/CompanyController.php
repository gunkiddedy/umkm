<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function companyDetail($id)
    {        
        $user = User::find($id);
        $provinsi = User::find($id)->provinsi;
        $kabupaten = User::find($id)->kabupaten;
        $kecamatan = User::find($id)->kecamatan;
        // $products = User::find($id)->products;
        $products = Product::where('user_id', '=', $id)->paginate(5);
        return response()->json([
            'user' => $user,
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'products' => $products,
        ]);
    }

    public function updateCompanyProfile(Request $request, $user_id)
    {
        // $user_id = Auth::id();
        
        $user = User::find($user_id);
        $user->additional_info = $request->get('additional_info');
        $user->save();
        
        return response()->json('info successfuly updated');
    }

}
