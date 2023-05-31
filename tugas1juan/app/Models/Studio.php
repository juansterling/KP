<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Theater;
use App\Models\Film;
use Illuminate\Database\Eloquent\SoftDeletes;

class Studio extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'jenis_studio',
        'studio',
        'theater_id'
    ];
    
    protected $table = "studios";
    const JENIS = ['basic', '3D', '4DX', 'starium', 'IMAX'];
    public function studio_theater(){
        return $this->belongsTo(Theater::class,"theater_id");
    }
    public function studio_film(){
        return $this->belongsToMany(Film::class,"studios_films","studio_id","film_id");
    }
}
