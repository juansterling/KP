<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use App\Models\matkul;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\QueryException;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->delcom == 1){
            $delmahasiswa = mahasiswa::firstWhere("nrp",$request->nrp);
            $delmahasiswa->delete();
        }

        $mahasiswas = mahasiswa::all();
        $matkuls = matkul::all();
        $matkulcoll = [];
        foreach($matkuls as $item){
            $matkulcoll[$item->idmatkul]="Mata kuliah ".$item->matkul;
        }
        // dd($matkulcoll);
        // return view("mahasiswa.welcome",["mahasiswa"=>$mahasiswas,"matkul"=>$matkuls]);
        return view("mahasiswa.welcome",["mahasiswa"=>$mahasiswas,"matkul"=>$matkulcoll]);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datanrp = $request->nrp;
        $datanama = $request->nama;
        $datafk = $request->fkmatkul;
        $mahasiswas = new Mahasiswa();
        $mahasiswas->nrp=$datanrp;
        $mahasiswas->nama=$datanama;
        $mahasiswas->fkmatkul=$datafk;
        try {
            $mahasiswas->save();
        } catch (QueryException $e) {

            return back()->withErrors(["status"=>"Fail to input data"]);
        }
        return redirect("/home");
    }

    /**
     * Display the specified resource.
     */
    public function show(mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(mahasiswa $mahasiswa)
    {
        $matkuls = matkul::all();
        foreach($matkuls as $item){
            $matkulcoll[$item->idmatkul]="Mata kuliah ".$item->matkul;
        }
        return view("mahasiswa.edit",["mahasiswa"=>$mahasiswa,"matkul"=>$matkulcoll]);
    }
    public function update(Request $request, mahasiswa $mahasiswa)
    {
        $nama = $request->nama;
        $matkul = $request->fkmatkul;
        $mahasiswa->nama=$nama;
        $mahasiswa->fkmatkul=$matkul;
        $mahasiswa->update();
        return redirect("/home");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(mahasiswa $delnrp)
    {
        $result = $delnrp->delete();
        if($result){
            return response()->json(["status"=>"success"]);
        }else{
            return response()->json(["status"=>"error"]);
        }
    }
}
