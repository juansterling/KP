@extends('master')
@section("content")
    <h1>Edit Semester</h1>
    {{Form::open(["method"=>"POST"])}}
    {{Form::hidden("_method","PATCH")}}
    {{Form::text("idsemester",$semester->idsemester,["placeholder"=>"ID Semester"])}}
    {{Form::text("semester",$semester->idsemester,["placeholder"=>"Semester"])}}
    {{Form::submit("Update")}}
    {{Form::close()}}
@endsection
