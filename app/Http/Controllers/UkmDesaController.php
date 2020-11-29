<?php

namespace App\Http\Controllers;
use App\Ukm;
use Illuminate\Http\Request;

class UkmDesaController extends Controller
{
    public function index(Request $request, $id)
    {   
        $ukm_desa = Ukm::where('dfdesa_id', $id)->paginate();
        
        return response()->json($ukm_desa);
    }

    public function getRecords( Request $request, $id) 
    {
        $search_nama_usaha = $request->searchTerm;

        $ukm_desa = Ukm::where([
            ['nama_usaha', 'LIKE', '%' . $search_nama_usaha . '%'],
            ['dfdesa_id', $id]
        ])->paginate()->toArray();

        if ( $search_nama_usaha ) 
            $ukm_desa['searchTerm'] = $search_nama_usaha ?: '';
        else
            $ukm_desa['searchTerm'] = $search_nama_usaha ? null : '';
     
        return response()->json($ukm_desa);
    }
}
