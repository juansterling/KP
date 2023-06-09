<?php

namespace App\Models\Master\Requirement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Master\ResearchScheme;

class ResearchReqDetail extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'research_scheme_id',
        'min_mandatory_output',
        'min_student',
        'max_student',
        'disciplines',
        'student_transport_cost',
        'student_transport_period',
        'waiting_period',
        'waiting_span'
    ];
    protected $table = "mst_research_req_details";
    protected $primaryKey = "research_scheme_id";
    const DISCIPLINES = ['MONO', 'MULTI', 'MONO / MULTI'];
    const TRANSPORT_PERIOD = ['hari', 'minggu', 'bulan', 'semester', 'tahun', 'penelitian'];
    const WAITING_SPAN = ['hari', 'minggu', 'bulan', 'tahun'];
    public function rrdetail_researchscheme()
    {
        return $this->belongsTo(ResearchScheme::class, "research_scheme_id");
    }
}
