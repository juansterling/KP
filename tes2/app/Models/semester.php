<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class semester extends Model
{
    protected $primaryKey="idsemester";
    public $incrementing = false;
    use HasFactory;
}
