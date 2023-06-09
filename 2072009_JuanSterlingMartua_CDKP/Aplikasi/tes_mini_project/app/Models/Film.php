<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FilmDetail;
use App\Models\Studio;
use Illuminate\Database\Eloquent\SoftDeletes;

class Film extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'film',
        'durasi',
        'rating',
        'sinopsis'
    ];
    protected $table = "films";
    const RATING = ['SU', 'PG-13', 'R'];
    public function film_filmdetail(){
        return $this->hasOne(FilmDetail::class,"film_id");
    }
    public function film_studio(){
        return $this->belongsToMany(Studio::class,"studios_films","film_id","studio_id");
    }
}
