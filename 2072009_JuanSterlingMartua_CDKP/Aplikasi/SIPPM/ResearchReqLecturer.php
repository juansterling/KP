<?php

namespace App\Models\Master\Requirement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Master\ResearchScheme;
use App\Models\Master\AcademicPosition;

class ResearchReqLecturer extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'research_scheme_id',
        'lecturer_reqs',
        'min_lecturer',
        'max_lecturer',
        'min_lead_position_id',
        'max_lead_position_id',
        'min_lead_position_strata',
        'max_lead_position_strata',
        'maximum_age',
        'min_member',
        'min_member_position_id',
        'min_member_position_strata',
        'min_partner',
        'min_partner_position_id',
        'min_partner_position_strata'
    ];
    protected $table = "mst_research_req_lecturers";
    protected $primaryKey = "research_scheme_id";
    const LECTURER = ['NIDN', 'NIDK', 'NIDN/NIDK'];
    const STRATA = ['D-III', 'S-1', 'S-2', 'S-3', 'PROFESI'];
    public function rrlecturer_researchscheme(){
        return $this->belongsTo(ResearchScheme::class,"research_scheme_id");
    }
    public function rrlecturer_leadposmin(){
        return $this->belongsTo(AcademicPosition::class,"min_lead_position_id");
    }
    public function rrlecturer_leadposmax(){
        return $this->belongsTo(AcademicPosition::class,"max_lead_position_id");
    }
    public function rrlecturer_memberposmin(){
        return $this->belongsTo(AcademicPosition::class,"min_member_position_id");
    }
    public function rrlecturer_memberposmax(){
        return $this->belongsTo(AcademicPosition::class,"max_member_position_id");
    }
    public function rrlecturer_partnerposmin(){
        return $this->belongsTo(AcademicPosition::class,"min_partner_position_id");
    }
    public function rrlecturer_partnerposmax(){
        return $this->belongsTo(AcademicPosition::class,"max_partner_position_id");
    }
}
