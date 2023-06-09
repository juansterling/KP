@extends('master')
@section("content")
    <h1>Edit Mata Kuliah</h1>
    {{Form::open(["method"=>"POST"])}}
    {{Form::hidden("_method","PATCH")}}
    {{Form::text("idmatkul",$matkul->idmatkul,["placeholder"=>"ID Matkul","readonly"])}}
    {{Form::text("matkul",$matkul->matkul,["placeholder"=>"Mata kuliah"])}}
    {{Form::select("sks",["2"=>"2 SKS","3"=>"3 SKS","4"=>"4 SKS"],$matkul->sks)}}
    {{Form::select("fksemester",$semester,$matkul->fksemester)}}
    {{Form::submit("Update")}}
    {{Form::close()}}
@endsection
