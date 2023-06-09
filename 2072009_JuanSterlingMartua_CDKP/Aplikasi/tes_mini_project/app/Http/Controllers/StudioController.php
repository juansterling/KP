<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Studio;
use App\Models\Theater;
use Illuminate\Database\QueryException;
class StudioController extends Controller
{
    //
    public function index_studio(Request $request)
    {
        $filter = $request->theater;
        if(isset($filter)){
            $studios = Studio::where('theater_id',$filter)->orderBy('theater_id','ASC')->get();
        }else{
            $studios = Studio::orderBy('theater_id','ASC')->get();
        }
        
        $theaters = Theater::orderBy("nama_bioskop","ASC")->get();
        $theatercoll = [];
        foreach($theaters as $item){
            $theatercoll[$item->id]=$item->nama_bioskop ."-". $item->kota;
        }
        $jeniscoll = [];
        foreach(Studio::JENIS as $item){
            $jeniscoll[$item]=$item;
        }
        return view("studio",["studios"=>$studios,"theatercoll"=>$theatercoll,"jeniscoll"=>$jeniscoll,"selected"=>$filter]);
    }
    public function store_studio(Request $request){
        $datatheaterid = $request->Bioskop;
        $datajenisstudio = $request->Jenis_Studio;
        $datastudio = $request->Studio;
        $studios = new Studio();
        $studios->theater_id=$datatheaterid;
        $studios->jenis_studio=$datajenisstudio;
        $studios->studio=$datastudio;
        try {
            $studios->save();
        } catch (QueryException $e) {
            return back()->withErrors("Fail to input data");
        }
        $theaters = Theater::find($datatheaterid);
        $theaters->jumlah_studio = count(Studio::where("theater_id",$datatheaterid)->get());
        try {
            $theaters->update();
        } catch (QueryException $e) {
            return back()->withErrors("Fail to input data");
        
        }
        return redirect("/studio");
    }
    public function update_studio(Request $request){
        $studios = Studio::find($request->id);
        $oldid = $studios->theater_id;
        $datatheaterid = $request->Edit_Bioskop;
        $datajenisstudio = $request->Edit_Jenis_Studio;
        $datastudio = $request->Edit_Studio;
        $studios->theater_id=$datatheaterid;
        $studios->jenis_studio=$datajenisstudio;
        $studios->studio=$datastudio;
        try {
            $studios->update();
        } catch (QueryException $e) {

            return back()->withErrors(["status"=>"Fail to update data"]);
        }
        if($oldid != $datatheaterid){
            $theatersold = Theater::find($oldid);
            $theatersold->jumlah_studio=count(Studio::where("theater_id",$oldid)->get());
            $theaters = Theater::find($datatheaterid);
            $theaters->jumlah_studio=count(Studio::where("theater_id",$datatheaterid)->get());
            try {
                $theatersold->update();
                $theaters->update();
            } catch (QueryException $e) {
                return back()->withErrors(["status"=>"Fail to update data"]);
            }
        }
        return redirect("/studio");
    }
    public function delete_studio(Request $request){
        $id = $request->id;
        $studios = Studio::find($id);
        $oldid = $studios->theater_id;
        if($studios != null){
            $result = $studios->delete();
        }
        $theaters = Theater::find($oldid);
        $theaters->jumlah_studio = count(Studio::where("theater_id",$oldid)->get());
        $result2 = $theaters->update();
        if($result && $result2){
            return redirect("/studio");
        }else{
            return back()->withErrors("Fail to Delete");
        }
    }
}
