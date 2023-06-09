<?php

namespace App\Http\Controllers;

use App\Models\matkul;
use App\Models\semester;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class MatkulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if($request->delcom == 1){
            $delmatkul= matkul::firstWhere("idmatkul",$request->idmatkul);
            $delmatkul->delete();
        }

        $matkuls = matkul::all();
        $semesters = semester::all();
        $semestercoll = [];
        foreach($semesters as $item){
            $semestercoll[$item->idsemester]="Semester ".$item->semester;
        }

        // return view("matkul.matkul",["matkul"=>$matkuls,"semester"=>$semesters]);
        return view("matkul.matkul",["matkul"=>$matkuls,"semester"=>$semestercoll]);
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
        $dataidmatkul = $request->idmatkul;
        $datamatkul = $request->matkul;
        $datasks = $request->sks;
        $datafksemester = $request->fksemester;
        $matkuls = new matkul();
        $matkuls->idmatkul=$dataidmatkul;
        $matkuls->matkul=$datamatkul;
        $matkuls->sks=$datasks;
        $matkuls->fksemester=$datafksemester;
        try {
            $matkuls->save();
        } catch (QueryException $e) {

            return back()->withErrors(["status"=>"Fail to input data"]);
        }
        return redirect("/matkul");
    }

    /**
     * Display the specified resource.
     */
    public function show(matkul $matkul)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(matkul $matkul)

    {
        $semesters = semester::all();
        $semestercoll = [];
        foreach($semesters as $item){
            $semestercoll[$item->idsemester]="Semester ".$item->semester;
        }

        return view("matkul.editmatkul",["matkul"=>$matkul,"semester"=>$semestercoll]);
    }

    public function update(Request $request, matkul $matkul)
    {
        $namamatkul = $request->matkul;
        $nomatkul = $request->idmatkul;
        $sksmatkul = $request->sks;
        $semmatkul = $request->fksemester;
        $matkul->matkul=$namamatkul;
        $matkul->idmatkul=$nomatkul;
        $matkul->sks=$sksmatkul;
        $matkul->fksemester=$semmatkul;
        $matkul->update();
        return redirect("/matkul");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(matkul $delidmatkul)
    {
        $result = $delidmatkul->delete();
        // $delidmatkul->delete();
        if($result){
            return response()->json(["status"=>"success"]);
        }else{
            return response()->json(["status"=>"error"]);
        }
    }
}
