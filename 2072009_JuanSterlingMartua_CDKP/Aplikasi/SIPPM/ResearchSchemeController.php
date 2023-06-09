<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\AcademicPosition;
use App\Models\Master\ResearchScheme;
use App\Models\Master\Requirement\ResearchReqDetail;
use App\Models\Master\Requirement\ResearchReqLecturer;
use App\Models\Master\Output;
use App\Models\Master\Requirement\ResearchReqBudget;
use App\Models\Master\Requirement\ResearchReqOutput;
use App\Models\Master\StudentProgramme;
use Illuminate\Database\QueryException;
use Validator;

class ResearchSchemeController extends Controller
{
    public function index_research_req_lecturer($research_scheme_id){

        $researchScheme = ResearchScheme::find($research_scheme_id);
        $researchReqDosen = $researchScheme->researchscheme_rrlecturer;
        $academicPositions = AcademicPosition::all()->pluck('position', 'id')->toArray();
        $strata = array_combine(ResearchReqLecturer::STRATA,ResearchReqLecturer::STRATA);
        $lecturers = array_combine(ResearchReqLecturer::LECTURER,ResearchReqLecturer::LECTURER);
        return view('dashboard.master.requirement.research-req-lecturer',
            compact('researchReqDosen', 'researchScheme','strata', 'lecturers','academicPositions')
        );
    }
    public function store_research_req_lecturer(Request $request)
{
    $research_scheme_id = $request->id;
    $research_scheme = ResearchScheme::find($research_scheme_id);

    if (!$research_scheme) {
        return back()->withErrors('Prasyarat Skema Penelitian tidak ada');
    }

    $research_req_dosen = ResearchReqLecturer::where('research_scheme_id', $research_scheme_id)->first();
    if (!$research_req_dosen) {
        $research_req_dosen = new ResearchReqLecturer();
        $research_req_dosen->research_scheme_id = $research_scheme_id;
    }

    $research_req_dosen->lecturer_reqs = $request->prasyarat_dosen;
    $research_req_dosen->min_lecturer = $request->min_dosen;
    $research_req_dosen->max_lecturer = $request->max_dosen;
    $research_req_dosen->min_lead_position_id = $request->min_lead_pos_id;
    $research_req_dosen->min_lead_position_strata = $request->min_strata;
    $research_req_dosen->max_lead_position_strata = $request->max_strata;
    $research_req_dosen->max_lead_position_id = $request->max_lead_pos_id;
    $research_req_dosen->maximum_age = $request->maximum_age;
    $research_req_dosen->min_member = $request->min_member;
    $research_req_dosen->min_member_position_id = $request->min_mmbr_pos_id;
    $research_req_dosen->min_member_position_strata = $request->min_mmbr_pos_strata;
    $research_req_dosen->min_partner = $request->jumlah_mitra;
    $research_req_dosen->min_partner_position_id = $request->min_partner_pos_id;
    $research_req_dosen->min_partner_position_strata = $request->min_partner_pos_strata;


    $research_req_dosen->save();

    return redirect('/master/skema-penelitian/'.$research_scheme_id.'/requirement/dosen')->with('success', 'Prasyarat telah berhasil diperbarui');
}


    public function index_research_req_detail($research_scheme_id)
    {

        $researchScheme = ResearchScheme::find($research_scheme_id);
        $researchReqDetail = $researchScheme->researchscheme_rrdetail;
        $disiplin = array_combine(ResearchReqDetail::DISCIPLINES, ResearchReqDetail::DISCIPLINES);
        $transportPeriode = array_combine(ResearchReqDetail::TRANSPORT_PERIOD, ResearchReqDetail::TRANSPORT_PERIOD);
        $waitingSpan = array_combine(ResearchReqDetail::WAITING_SPAN, ResearchReqDetail::WAITING_SPAN);
        return view(
            'dashboard.master.requirement.research-req-detail',
            compact('researchReqDetail', 'disiplin', 'waitingSpan', 'transportPeriode')
        );
    }
    public function store_research_req_detail(Request $request)
    {
        $validatedData = $request->validate([
            'min_mandatory_output' => 'required',
            'min_mhs' => 'required',
        ]);

        $research_scheme_id = $request->id;
        $research_scheme = ResearchScheme::find($research_scheme_id);

        if (!$research_scheme) {
            return back()->withErrors('Prasyarat Skema Penelitian gagal disimpan');
        }

        $research_req_detail = ResearchReqDetail::where('research_scheme_id', $research_scheme_id)->first();
        if (!$research_req_detail) {
            $research_req_detail = new ResearchReqDetail();
            $research_req_detail->research_scheme_id = $research_scheme_id;
        }

        $research_req_detail->min_mandatory_output = $validatedData['min_mandatory_output'];
        $research_req_detail->min_student = $validatedData['min_mhs'];
        $research_req_detail->max_student = $request->max_mhs;
        $research_req_detail->disciplines = $request->disiplin;
        $research_req_detail->student_transport_cost = $request->biaya_transport_mhs;
        $research_req_detail->student_transport_period = $request->periode_transport_mhs;
        $research_req_detail->waiting_period = $request->waiting_periode;
        $research_req_detail->waiting_span = $request->waiting_span;

        $research_req_detail->save();

        return redirect('/master/skema-penelitian/' . $research_scheme_id . '/requirement/detail')->with('success', 'Prasyarat Skema Penelitian telah berhasil diperbarui');
    }


    public function index_research_scheme()
    {
        $table_data = ResearchScheme::all();
        $disiplin = array_combine(ResearchReqDetail::DISCIPLINES, ResearchReqDetail::DISCIPLINES);
        $tp = array_combine(ResearchReqDetail::TRANSPORT_PERIOD, ResearchReqDetail::TRANSPORT_PERIOD);
        $ws = array_combine(ResearchReqDetail::WAITING_SPAN, ResearchReqDetail::WAITING_SPAN);
        return view('dashboard.master.research-scheme-index', compact('table_data', 'disiplin', 'tp', 'ws'));
    }

    public function store_research_scheme(Request $request)
    {
        Validator::make(
            $request->all(),
            [
                'skema_penelitian' => 'required',
                'luaran_wajib' => 'required',
                'minimal_mahasiswa' => 'required',
            ]
        )->validate();
        $id = '';
        $rs = ResearchScheme::onlyTrashed()
            ->where('research_scheme', $request->skema_penelitian)
            ->first();
        if ($rs != null) {
            $rs->restore();
            $rrd = ResearchReqDetail::onlyTrashed()
                ->where('research_scheme_id', $rs->id)
                ->first();
            $rrd->restore();
            $rs->update(['status' => $request->status == '' ? false : true]);
            $rrd->update([
                'min_mandatory_output' => $request->luaran_wajib,
                'min_student' => $request->minimal_mahasiswa,
                'max_student' => $request->maksimal_mahasiswa,
                'disciplines' => $request->disiplin,
                'student_transport_cost' => $request->biaya_transport_mhs,
                'student_transport_period' => $request->ptm,
                'waiting_period' => $request->pmt,
                'waiting_span' => $request->rwt
            ]);
            $id = $rs->id;
        } else {
            $insert = new ResearchScheme;
            $insert->research_scheme = $request->skema_penelitian;
            $insert->status = $request->status == '' ? false : true;
            if ($insert->save()) {
                $insert2 = new ResearchReqDetail;
                $insert2->research_scheme_id = $insert->id;
                $insert2->min_mandatory_output = $request->luaran_wajib;
                $insert2->min_student = $request->minimal_mahasiswa;
                $insert2->max_student = $request->maksimal_mahasiswa;
                $insert2->disciplines = $request->disiplin;
                $insert2->student_transport_cost = $request->biaya_transport_mhs;
                $insert2->student_transport_period = $request->ptm;
                $insert2->waiting_period = $request->pmt;
                $insert2->waiting_span = $request->rwt;
                $insert2->save();
            }
            $id = $insert->id;
        }
        return redirect('/master/skema-penelitian/' . $id . '/requirement')->with('custom_success', 'Skema Penelitian telah berhasil ditambahkan');
    }

    public function update_status(Request $request)
    {
        $find = ResearchScheme::find($request->id);
        if (!empty($find)) {
            $find->update([
                'status' => $request->status
            ]);
        }
        if ($request->status == 'true') {
            return response()->json(["response_code" => "00", 'message' => 'Skema Penelitian berhasil diaktifkan'], 200);
        } else {
            return response()->json(["response_code" => "00", 'message' => 'Skema Penelitian berhasil di-nonaktifkan'], 200);
        }
    }

    public function update_research_scheme(Request $request)
    {
        Validator::make(
            $request->all(),
            [
                'skema_penelitian' => 'required',
                'luaran_wajib' => 'required',
                'minimal_mahasiswa' => 'required',
            ]
        )->validate();

        $find = ResearchScheme::find($request->id);
        if (!empty($find)) {
            $find->update([
                'research_scheme' => $request->skema_penelitian,
                'status' => $request->status == '' ? false : true,
            ]);

            $rrd = ResearchReqDetail::where('research_scheme_id', $request->id)->first();
            $rrd->update([
                'min_mandatory_output' => $request->luaran_wajib,
                'min_student' => $request->minimal_mahasiswa,
                'max_student' => $request->maksimal_mahasiswa,
                'disciplines' => $request->disiplin,
                'student_transport_cost' => $request->biaya_transport_mhs,
                'student_transport_period' => $request->ptm,
                'waiting_period' => $request->pmt,
                'waiting_span' => $request->rwt,
            ]);

            return redirect('/master/skema-penelitian/' . $request->id . '/requirement')->with('custom_success', 'Skema Penelitian telah berhasil diubah');
        } else {
            return redirect('/master/skema-penelitian/')->with('custom_error', 'Data tidak ditemukan');
        }
    }

    public function delete_research_scheme(Request $request)
    {
        $find = ResearchScheme::find($request->id);
        if ($find == null) {
            return back('/master/skema-penelitian/')->with('custom_error', 'Data tidak ditemukan');
        }
        try{
            $find->delete();
            $rrd = ResearchReqDetail::where('research_scheme_id', $request->id)->first()->delete();
        }catch(QueryException $e){
            return back()->with("custom_error", $e->getMessage());
        }
            return redirect('/master/skema-penelitian/')->with('custom_success', 'Skema Penelitian telah berhasil dihapus');
    }

    public function index_research_sp_req($research_scheme_id)
    {
        $schemes = ResearchScheme::find($research_scheme_id);
        $reqprograms = $schemes->researchscheme_studentprogramme;
        $programs = StudentProgramme::all();
        $programcoll = [];
        foreach ($programs as $item) {
            $programcoll[$item->id] = $item->programme_name;
        }
        return view('dashboard.master.requirement.research-req-sp', compact("programcoll", "schemes", "reqprograms"));
    }

    public function store_research_req_sp(Request $request, $research_scheme_id)
    {
        $schemes = ResearchScheme::find($research_scheme_id);
        if($request->namaprogram == null){
            return back()->withErrors("Gagal menambahkan Prasyarat");
        }
        try {
            $schemes->researchscheme_studentprogramme()->attach($request->namaprogram);
        } catch (QueryException $e) {
            return back()->withErrors("Gagal menambahkan Prasyarat");
        }

        return redirect("/master/skema-penelitian/" . $research_scheme_id . "/requirement/program")->with("message", "Prasyarat telah berhasil ditambahkan");
    }

    public function delete_research_req_sp(Request $request, $research_scheme_id)
    {
        $schemes = ResearchScheme::find($research_scheme_id);
        if ($schemes == null) {
            return back()->withErrors(["status" => "Data tidak ditemukan"]);
        }
        try {
            $schemes->researchscheme_studentprogramme()->detach($request->id);
        } catch (QueryException $e) {
            return back()->withErrors(["status" => "Gagal menghapus Program Mahasiswa"]);
        }
        return redirect('master/skema-penelitian/' . $research_scheme_id . '/requirement/program')->with("message", "Program Mahasiswa telah berhasil dihapus");
    }
    public function index_research_req($research_scheme_id)
    {
        $scheme = ResearchScheme::find($research_scheme_id);
        return view('dashboard.master.requirement.research-req', compact('research_scheme_id', 'scheme'));
    }

    public function index_research_req_output($research_scheme_id)
    {
        $data = ResearchScheme::find($research_scheme_id);
        $outputs = Output::all();
        $research_req_output = ResearchReqOutput::all();
        $luaran = [];

        foreach ($outputs as $item) {
            $luaran[$item->id] = $item->output_name;
        }

        $category = array_combine(ResearchReqOutput::CATEGORY, ResearchReqOutput::CATEGORY);
        return view('dashboard.master.requirement.research-req-output',compact('data', 'outputs', 'research_req_output', 'luaran', 'category'));
    }

    public function store_research_req_output(Request $request, $research_scheme_id)
    {
        $validated = $request->validate([
            'Luaran' => 'required',
            'Kategori' => 'required',
            'judul_luaran' => 'required'
        ]);
        $research_req_output = new ResearchReqOutput();
        $research_req_output->research_scheme_id = $research_scheme_id;
        $research_req_output->output_id = $validated['Luaran'];
        $research_req_output->category = $validated['Kategori'];
        $research_req_output->output_title = $validated['judul_luaran'];
        $research_req_output->min_grade = $request->strata_minimal;
        $research_req_output->max_grade = $request->strata_maksimal;

        try {
            $research_req_output->save();
        } catch (QueryException $e) {
            return back()->withErrors("Gagal menambahkan Prasyarat");
        }
        return redirect('master/skema-penelitian/' . $research_scheme_id . '/requirement/luaran')->with('message', 'Prasyarat berhasil ditambahkan');
    }

    public function update_research_req_output(Request $request, $research_scheme_id)
    {
        $validated = $request->validate([
            'id' => 'required',
            'Luaran' => 'required',
            'Kategori' => 'required',
            'judul_luaran' => 'required'
        ]);

        $research_req_output = ResearchReqOutput::find($validated['id']);
        if ($research_req_output != null) {
            $research_req_output->research_scheme_id = $research_scheme_id;
            $research_req_output->output_id = $validated['Luaran'];
            $research_req_output->category = $validated['Kategori'];
            $research_req_output->output_title = $validated['judul_luaran'];
            $research_req_output->min_grade = $request->strata_minimal;
            $research_req_output->max_grade = $request->strata_maksimal;
            try {
                $research_req_output->update();
            } catch (QueryException $e) {
                return back()->withErrors('Gagal memperbaharui Prasyarat');
            }
            return redirect('master/skema-penelitian/' . $research_scheme_id . '/requirement/luaran')->with('message', 'Prasyarat berhasil diperbaharui');
        } else {
            return back()->withErrors('Gagal memperbaharui Prasyarat');
        }
    }

    public function delete_research_req_output(Request $request, $research_scheme_id)
    {
        $research_req_output = ResearchReqOutput::find($request->delId);

        if ($research_req_output != null) {
            try {
                $research_req_output->delete();
            } catch (QueryException $e) {
                return back()->withErrors('message', 'Gagal menghapus Prasyarat');
            }

            return redirect('master/skema-penelitian/' . $research_scheme_id . '/requirement/luaran')->with('message', 'Prasyarat berhasil dihapus');
        } else {
            return back()->withErrors('message', 'Data tidak ditemukan');
        }
    }

    public function index_research_req_budget($research_scheme_id){
        $researchScheme = ResearchScheme::find($research_scheme_id);
        $researchBudget = $researchScheme->researchscheme_rrbudget;

        $ejmPeriodTypes = array_combine(ResearchReqBudget::TYPE, ResearchReqBudget::TYPE);

        return view("dashboard.master.requirement.research-req-budget", compact("research_scheme_id", "researchScheme", "researchBudget", "ejmPeriodTypes"));
    }

    public function store_research_req_budget($research_scheme_id, Request $request){
        $validated = $request->validate([
            "anggaranMin" => "required",
            "anggaranMax" => "min:0",
            "kepalaEJM" => "min:0",
            "memberEJM" => "min:0",
            "periodeEJM" => "min:0"
        ]);

        $researchBudget = ResearchReqBudget::find($research_scheme_id);

        if ($researchBudget == null){
            // Jika tidak ada, buat budget penelitian baru
            $researchBudget = new ResearchReqBudget();
            $researchBudget->research_scheme_id = $research_scheme_id;
        }

        $researchBudget->min_budget = $validated["anggaranMin"];
        $researchBudget->max_budget = $validated["anggaranMax"];
        $researchBudget->lead_ejm = $validated["kepalaEJM"];
        $researchBudget->member_ejm = $validated["memberEJM"];
        $researchBudget->ejm_period = $validated["periodeEJM"];
        $researchBudget->ejm_period_type = $request->tipePeriodeEJM;

        try {
            $researchBudget->save();    // memanggil save pada data yang sudah ada akan mengupdate juga
        } catch (QueryException $e){
            return back()->withErrors("Gagal memperbarui prasyarat");
        }

        return redirect("/master/skema-penelitian/" . $research_scheme_id . "/requirement/anggaran")->with("message", "Prasyarat telah berhasil diperbarui");
    }
}
