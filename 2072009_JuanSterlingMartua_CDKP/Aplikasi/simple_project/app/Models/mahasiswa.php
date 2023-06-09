<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\mahasiswafactoryFactory;

class mahasiswa extends Model
{
    
    use HasFactory;
    protected $primaryKey="nrp";
    public $incrementing = false;

    protected static function newFactory(){
        return mahasiswafactoryFactory::new();
    }
    public function getMatkul(){
        return $this->hasMany(matkul::class,"idmatkul","fkmatkul");
    }
}
