<?php

namespace App\Http\Controllers\api;
use App\Models\semester;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SemesterApiController extends Controller
{
    //
    public function getSemester(Request $request)
    {   
        $semester=semester::all();
        return response()->json($semester);
        //
    }
    public function insertSemester(Request $request){
        $semester = new semester();
        $semester->idsemester=$request->idsemester;
        $semester->semester=$request->semester;
        $semester->save();
        return response()->json(["status"=>"success"]);
    }
    public function updateSemester(Request $request){
        $semester = semester::find($request->idsemester);
        if($semester != null){
            $semester->semester=$request->semester;
        $semester->update();
        return response()->json(["status"=>"success"]);
        }
        else{
            return response()->json(["status"=>"fail"]);
        }
    }
    public function deleteSemester(Request $request){
        $semester = semester::find($request->idsemester);
        if($semester != null){
            $semester->delete();
        return response()->json(["status"=>"success"]);
        }
        else{
            return response()->json(["status"=>"fail"]);
        }
    }
}
