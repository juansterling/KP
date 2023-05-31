<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\FilmDetail;
use Illuminate\Database\QueryException;
class FilmController extends Controller
{
    //
    public function index_film()
    {
        $films = Film::orderBy("film","ASC")->get();
        $ratingcoll = [];
        foreach(Film::RATING as $item){
            $ratingcoll[$item]=$item;
        }
        $bahasacoll = [];
        foreach(FilmDetail::BAHASA as $item){
            $bahasacoll[$item]=$item;
        }
        return view("film",["films"=>$films,"ratingcoll"=>$ratingcoll,"bahasacoll"=>$bahasacoll]);
    }

    public function store_film(Request $request){
        $validation = $request->validate([
            "judul_film"=>"required | unique:films,film"
        ]);
        $datafilm = $validation["judul_film"];
        $datadurasi = $request->durasi;
        $datarating = $request->rating;
        $datasinopsis = $request->sinopsis;
        $datajadwalrilis = $request->jadwal_rilis;
        $databahasa = $request->bahasa;
        $films = new Film();
        $details = new FilmDetail();
        $films->film=$datafilm;
        $films->durasi=$datadurasi;
        $films->rating=$datarating;
        $films->sinopsis=$datasinopsis;
        try {
            $films->save();
        } catch (QueryException $e) {

            return back()->withErrors(["status"=>"Fail to input data"]);
        }
        $details->film_id=$films->id;
        $details->jadwal_rilis=$datajadwalrilis;
        $details->bahasa=$databahasa;
        try {
            $details->save();
        } catch (QueryException $e) {
            $films->forceDelete();
            return back()->withErrors(["status"=>"Fail to input data"]);
        }
        return redirect("/film");
    }

    public function update_film(Request $request){
        $film = Film::find($request->id);
        if($film->film == $request->edit_judul_film){
            $validation = $request->validate([
                "edit_judul_film"=>"required"
            ]);
        }else{
            $validation = $request->validate([
                "edit_judul_film"=>"required | unique:films,film"
            ]);
        }
        $filmdetail = FilmDetail::find($request->id);
        $datafilm = $validation["edit_judul_film"];
        $datadurasi = $request->edit_durasi;
        $datarating = $request->edit_rating;
        $datasinopsis = $request->edit_sinopsis;
        $datajadwalrilis = $request->edit_jadwal_rilis;
        $databahasa = $request->edit_bahasa;
        $film->film=$datafilm;
        $film->durasi=$datadurasi;
        $film->rating=$datarating;
        $film->sinopsis=$datasinopsis;
        try {
            $film->update();
        } catch (QueryException $e) {

            return back()->withErrors(["status"=>"Fail to input data"]);
        }
        $filmdetail->film_id=$film->id;
        $filmdetail->jadwal_rilis=$datajadwalrilis;
        $filmdetail->bahasa=$databahasa;
        $filmdetail->update();
        try {
            $filmdetail->update();
        } catch (QueryException $e) {

            return back()->withErrors(["status"=>"Fail to input data"]);
        }
        return redirect("/film");
    }
    public function delete_film(Request $request){
        $id = $request->id;
        $film = Film::find($id);
        $filmdetail = FilmDetail::find($id);

        if($film != null && $filmdetail != null){
            $result = $filmdetail->forceDelete();
            $result = $film->forceDelete();
        } else {
            return back()->withErrors("Data tidak ada");
        }
        if($result){
            return redirect("/film");
        }else{
            return back()->withErrors("Fail to Delete");
        }
    }
}
