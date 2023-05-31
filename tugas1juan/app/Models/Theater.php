<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Studio;
use Illuminate\Database\Eloquent\SoftDeletes;

class Theater extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'nama_bioskop',
        'kota',
        'jumlah_studio',
    ];
    protected $table = "theaters";
    const KOTA = ['Bandung', 'Jakarta', 'Semarang', 'Surabaya', 'Yogyakarta'];
    public function theater_studio(){
        return $this->hasMany(Studio::class,"theater_id");
    }
}
