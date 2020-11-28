<?php

namespace App\Http\Controllers;
use App\Ukm;
use Illuminate\Http\Request;

class UkmDesaController extends Controller
{
    public function index(Request $request, $id)
    {   
        $ukm_desa = Ukm::where('dfdesa_id', $id)->paginate();
        // foreach($ukm_desa as $ukm){
        //     dd($ukm);
        //     $columns = [
        //         [ 'label' => 'Id', 'field' => 'id' ],
        //         [ 'label' => 'Nama Usaha', 'field' => 'nama_usaha' ]
        //     ];
        //     $rows = [
        //         'id' => $ukm['id'],
        //         'nama_usaha' => $ukm['nama_usaha']
        //     ];
        // }
        // $object_columns = json_encode($columns);
        // $object_rows = json_encode($rows);
        
        return response()->json($ukm_desa);
        
    }

    public function getRecords( Request $request, $id) {

        $search_nama_usaha = $request->searchTerm;
        $search_nama_pemilik = $request->searchTerm;
        $search_nik = $request->searchTerm;
        $search_alamat = $request->searchTerm;
        $search_bahan_baku = $request->searchTerm;
        $search_kriteria = $request->searchTerm;

        $ukm_desa = Ukm::where([
            ['nama_usaha', 'LIKE', '%' . $search_nama_usaha . '%'],
            ['dfdesa_id', $id]
        ])->paginate()->toArray();
        $ukm_desa = Ukm::where([
            ['nama_pemilik', 'LIKE', '%' . $search_nama_pemilik . '%'],
            ['dfdesa_id', $id]
        ])->paginate()->toArray();
        $ukm_desa = Ukm::where([
            ['nik', 'LIKE', '%' . $search_nik . '%'],
            ['dfdesa_id', $id]
        ])->paginate()->toArray();
        $ukm_desa = Ukm::where([
            ['alamat', 'LIKE', '%' . $search_alamat . '%'],
            ['dfdesa_id', $id]
        ])->paginate()->toArray();
        $ukm_desa = Ukm::where([
            ['bahan_baku', 'LIKE', '%' . $search_bahan_baku . '%'],
            ['dfdesa_id', $id]
        ])->paginate()->toArray();
        $ukm_desa = Ukm::where([
            ['kriteria', 'LIKE', '%' . $search_kriteria . '%'],
            ['dfdesa_id', $id]
        ])->paginate()->toArray();

        if ( $search_nama_usaha ) {
            $ukm_desa['searchTerm'] = $search_nama_usaha ?: '';
        } 
        elseif($search_nama_pemilik){
            $ukm_desa['searchTerm'] = $search_nama_pemilik ?: '';
        }
        elseif($search_nik){
            $ukm_desa['searchTerm'] = $search_nik ?: '';
        }
        elseif($search_alamat){
            $ukm_desa['searchTerm'] = $search_alamat ?: '';
        }
        elseif($search_bahan_baku){
            $ukm_desa['searchTerm'] = $search_bahan_baku ?: '';
        }
        elseif($search_kriteria){
            $ukm_desa['searchTerm'] = $search_kriteria ?: '';
        }
        else {
            $ukm_desa['searchTerm'] = $search_nama_usaha ? null : '';
        }
     
        return response()->json($ukm_desa);
    }
}
