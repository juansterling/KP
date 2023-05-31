<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class matkul extends Model
{
    use HasFactory;
    protected $primaryKey = "idmatkul";
    public $incrementing = false;

    public function getSemester(){
        return $this->belongsTo(semester::class,'fksemester');
    }
}
