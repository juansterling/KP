<?php

namespace App\Models\Master\Requirement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\ResearchScheme;
use App\Models\Master\Output;

class ResearchReqOutput extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'research_scheme_id',
        'output_id',
        'category',
        'output_title',
        'min_grade',
        'max_grade'
    ];
    protected $table = "mst_research_req_outputs";
    const CATEGORY = ['wajib', 'tambahan'];
    public function rroutput_researchscheme(){
        return $this->belongsTo(ResearchScheme::class,"research_scheme_id");
    }
    public function rroutput_output(){
        return $this->belongsTo(Output::class,"output_id");
    }
}
