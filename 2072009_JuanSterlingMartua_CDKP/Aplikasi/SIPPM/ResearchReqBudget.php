<?php

namespace App\Models\Master\Requirement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Master\ResearchScheme;

class ResearchReqBudget extends Model
{
    use HasFactory;
    protected $fillable = [
        'research_scheme_id',
        'min_budget',
        'max_budget',
        'lead_ejm',
        'member_ejm',
        'ejm_period',
        'ejm_period_type',
    ];
    protected $table = "mst_research_req_mandatory_output";
    protected $primaryKey = "research_scheme_id";
    const TYPE = ['semester', 'tahun', 'periode'];
    public function rrbudget_researchscheme(){
        return $this->belongsTo(ResearchScheme::class,"research_scheme_id");
    }
}
