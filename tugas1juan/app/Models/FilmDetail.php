<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Film;
use Illuminate\Database\Eloquent\SoftDeletes;

class FilmDetail extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'jadwal_rilis',
        'bahasa',
        'film_id'
    ];
    protected $primaryKey = "film_id";
    const BAHASA = ['indonesia', 'inggris', 'korea', 'thailand'];
    protected $table = "films_details";
    public function filmdetail_film(){
        return $this->belongsTo(Film::class,"film_id");
    }
}
