<?php

namespace App\Http\Controllers\api;
use App\Models\matkul;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MatkulApiController extends Controller
{
    //
    public function getMatkul(Request $request)
    {   
        $matkul=matkul::all();
        return response()->json($matkul);
        //
    }
}
