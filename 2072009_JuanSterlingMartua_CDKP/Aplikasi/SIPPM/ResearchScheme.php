<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Master\Requirement\ResearchReqLecturer;
use App\Models\Master\Requirement\ResearchReqDetail;
use App\Models\Master\Requirement\ResearchReqBudget;
use App\Models\Master\StudentProgramme;

class ResearchScheme extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'research_scheme',
        'status'
    ];
    protected $table = "mst_research_schemes";
    public function researchscheme_rrlecturer(){
        return $this->hasOne(ResearchReqLecturer::class,"research_scheme_id");
    }
    public function researchscheme_rrdetail(){
        return $this->hasOne(ResearchReqDetail::class,"research_scheme_id");
    }
    public function researchscheme_rrbudget(){
        return $this->hasOne(ResearchReqBudget::class,"research_scheme_id");
    }
    public function researchscheme_studentprogramme(){
        return $this->belongsToMany(StudentProgramme::class,"mst_research_req_programmes","research_scheme_id","student_programme_id");
    }
    public function researchscheme_rroutput(){
        return $this->hasMany(ResearchReqOutput::class,"research_scheme_id");
    }
}
