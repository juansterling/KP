@extends('master')
@section("content")
    <h1>Edit Mahasiswa</h1>
    {{Form::open(["method"=>"POST","files"=>true])}}
    {{Form::hidden("_method","PATCH")}}
    {{Form::text("nrp",$mahasiswa->nrp,["placeholder"=>"nrp","readonly"])}}
    {{Form::text("nama",$mahasiswa->nama,["placeholder"=>"nama"])}}
    {{Form::select("fkmatkul",$matkul,$mahasiswa->fkmatkul)}}
    {{Form::submit("Update")}}
    {{Form::close()}}
@endsection
