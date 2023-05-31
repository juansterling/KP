<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Theater;
use Illuminate\Database\QueryException;

class TheaterController extends Controller
{
    //
    public function index_theater()
    {
        $theaters = Theater::orderBy("nama_bioskop","ASC")->get();
        $kotacoll = [];
        foreach(Theater::KOTA as $item){
            $kotacoll[$item]=$item;
        }
        return view("theater",["theaters"=>$theaters,"kotacoll"=>$kotacoll]);
    }

    public function store_theater(Request $request){
        $datanamabioskop = $request->nama_bioskop;
        $datakota = $request->kota;
        $datastudio = 0;
        $theaters = new Theater();
        $theaters->nama_bioskop=$datanamabioskop;
        $theaters->kota=$datakota;
        $theaters->jumlah_studio=$datastudio;
        try {
            $theaters->save();
        } catch (QueryException $e) {

            return back()->withErrors(["status"=>"Fail to input data"]);
        }
        return redirect("/theater");
    }

    public function update_theater(Request $request){
        $theater = Theater::find($request->id);
        $datanamabioskop = $request->edit_nama_bioskop;
        $datakota = $request->edit_kota;
        $theater->nama_bioskop=$datanamabioskop;
        $theater->kota=$datakota;
        try {
            $theater->update();
        } catch (\Throwable $th) {
            return back()->withErrors(["status"=>"Fail to update data"]);
        }

        return redirect("/theater");
    }

    public function delete_theater(Request $request){
        $id = $request->id;
        $theater = Theater::find($id);
        if($theater != null){
            $result = $theater->delete();
        }
        if($result){
            return redirect("/theater");
        }else{
            return back()->withErrors("Fail to Delete");
        }
    }
}
