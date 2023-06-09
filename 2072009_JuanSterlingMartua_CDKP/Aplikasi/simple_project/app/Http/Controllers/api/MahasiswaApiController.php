<?php

namespace App\Http\Controllers\api;
use App\Models\mahasiswa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MahasiswaApiController extends Controller
{
    //
    public function getMahasiswa(Request $request)
    {   
        $mahasiswa=mahasiswa::all();
        return response()->json($mahasiswa);
        //
    }
}
