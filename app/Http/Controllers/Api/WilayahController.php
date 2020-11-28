<?php

namespace App\Http\Controllers\Api;

use App\Island;
use App\Provinsi;
use App\Kabupaten;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WilayahController extends Controller
{
    public function getProvinsis()
    {
        $provinsis = Provinsi::with('island')->get();

        return response()->json($provinsis);
    }

    public function getIslandWithProvinsis()
    {
        $islands = Island::with('provinsis')->get();

        return response()->json($islands);
    }

    public function getKabupatens()
    {
        $kabupatens = Provinsi::with('kabupatens')->get();

        return response()->json($kabupatens);
    }

    public function getKabupaten(Request $request)
    {
        $kabupatens = Kabupaten::where('provinsi_id', $request->provinsi_id)->get();

        return response()->json($kabupatens);
    }
}
