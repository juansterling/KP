<?php

namespace App\Http\Controllers;

use App\Models\semester;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->delcom == 1){
            $delsemester= semester::firstWhere("idsemester",$request->idsemester);
            $delsemester->delete();
        }

        $semesters = semester::all();
        return view("semester.semester",["semester"=>$semesters]);
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
        $dataidsemester = $request->idsemester;
        $datasemester = $request->semester;
        $semesters = new semester();
        $semesters->idsemester=$dataidsemester;
        $semesters->semester=$datasemester;

        try {
            $semesters->save();
        } catch (QueryException $e) {

            return back()->withErrors(["status"=>"Fail to input data"]);
        }

        return redirect("/semester");
    }

    /**
     * Display the specified resource.
     */
    public function show(semester $semester)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(semester $semester)
    {
        return view("semester.editsemester",["semester"=>$semester]);
    }

    public function update(Request $request, semester $semester)
    {
        $namasemester = $request->semester;
        $nosemester = $request->idsemester;
        $semester->semester=$namasemester;
        $semester->idsemester=$nosemester;
        $semester->update();
        return redirect("/semester");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(semester $delidsemester)
    {
        $result = $delidsemester->delete();
        // $delidsemester->delete();
        if($result){
            return response()->json(["status"=>"success"]);
        }else{
            return response()->json(["status"=>"error"]);
        }
    }
}
