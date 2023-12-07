<?php

namespace Database\Seeders;

use App\Models\Incentive\IncentiveDate;
use App\Models\Incentive\IncentiveHeader;
use App\Models\Master\Requirement\ScientificWorkReqDetail;
use App\Models\Master\ScientificWorkScheme;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class aoe extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table("users")->insert([
        //     "name" => "hai",
        //     "email" => "hai@email.com",
        //     "password" => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi",
        //     "role_id" => 2,
        //     "menuroles" => "dosen"
        // ]);
        // DB::table("mst_expertises")->insert([
        //     "faculty_id" => 1,
        //     "study_program_id" => 1,
        //     "expertise" => "Keahlian 1",
        //     "information" => "Ini adalah keahlian pertama"
        // ]);
        // DB::table("mst_expertises")->insert([
        //     "faculty_id" => 2,
        //     "study_program_id" => 2,
        //     "expertise" => "Keahlian 2",
        //     "information" => "Ini adalah keahlian kedua"
        // ]);
        // DB::table("users_expertises")->insert([
        //     "user_id" => 12,
        //     "expertise_id" => 1,
        // ]);
        // DB::table("users_expertises")->insert([
        //     "user_id" => 12,
        //     "expertise_id" => 2,
        // ]);
        // DB::table("mst_academic_positions")->insert([
        //     "position" => "ketua",
        // ]);
        // DB::table("mst_academic_positions")->insert([
        //     "position" => "wakil",
        // ]);
        // DB::table("mst_golru_categories")->insert([
        //     "academic_position_id" => 1,
        //     "golru" => "pelaksana"
        // ]);
        // DB::table("mst_golru_categories")->insert([
        //     "academic_position_id" => 2,
        //     "golru" => "anggota"
        // ]);
        // DB::table("users_lecturers")->insert([
        //     "user_id" => 12,
        //     "nik" => "1",
        //     "nidn" => "1",
        //     "golru_category_id" => 1,
        //     "academic_position_id" => 1
        // ]);

        // DB::table("users")->insert([
        //     "name" => "Fenita",
        //     "email" => "fenita@email.com",
        //     "password" => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi",
        //     "menuroles" => "dosen",
        //     "role_id" => 3,

        // ]);
        DB::table("users_lecturers")->insert([
            "user_id" => 15,
            "faculty_id" => 3,
            "study_program_id" => 3,
            "nik" => '1409',
            "nidn" => '0983',
            "mobile" => '08180099',
            // "golru_category_id"=>2,
            // "academic_position_id"=>2
        ]);
        DB::table("users")->insert([
            "name" => "Michelle",
            "email" => "michelle@email.com",
            "password" => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi",
            "menuroles" => "dosen",
            "role_id" => 3,

        ]);
        DB::table("users_lecturers")->insert([
            "user_id" => 16,
            "faculty_id" => 2,
            "study_program_id" => 2,
            "nik" => '1400',
            "nidn" => '0980',
            "mobile" => '08180090',
            // "golru_category_id"=>2,
            // "academic_position_id"=>2
        ]);
        // DB::table("users_expertises")->insert([
        //     "user_id" => 13,
        //     "expertise_id" => 1,
        // ]);
        // DB::table("users_educations")->insert([
        //     "user_id" => 1,
        //     "grade" => "uuu",
        //     "knowledge_field" => "oe",
        //     "college" => "haha",
        //     "start_year" => 2002,
        //     "end_year" => 2005,
        //     "final_project_type" => "tesis",
        //     "final_project_title" => "kkkk"
        // ]);
        // DB::table("users_educations_mentors")->insert([
        //     "user_education_id" => 1,
        //     "mentor_type" => "tik",
        //     "mentor_name" => "aaa"
        // ]);
        // DB::table("users_educations_mentors")->insert([
        //     "user_education_id" => 1,
        //     "mentor_type" => "hoho",
        //     "mentor_name" => "bbb"
        // ]);

        DB::table("mst_scientific_work_schemes")->insert([
            "sciwork_scheme" => "Skema 1",
            "status" => true,
            "category" => "buku"
        ]);
        DB::table("mst_student_programmes")->insert([
            "programme_name" => "Program 1",
        ]);
        DB::table("mst_area_of_expertises")->insert([
            "aoe" => "Keahlian 1",
        ]);

        DB::table("mst_research_schemes")->insert([
            "research_scheme" => "Skema Penelitian 1",
        ]);
        DB::table("mst_book_schemes")->insert([
            "book_scheme" => "Skema Buku 1",
        ]);
        DB::table("mst_book_schemes")->insert([
            "book_scheme" => "Skema Buku 2",
        ]);
        // DB::table("mst_book_req_details")->insert([
        //     "book_scheme_id" => 1,
        //     "min_lecturer" => 1,
        //     "max_lecturer" => 1,
        //     "min_mandatory_output" => 1,
        //     "duration_type" => "oe",
        //     "max_duration" => 1,
        //     "book_size" => "oe",
        //     "collected_print" => 1,
        //     "revision" => false,
        // ]);
        DB::table("mst_community_service_schemes")->insert([
            "comsv_scheme" => "Pelayanan 1",
        ]);
        DB::table("mst_community_service_req_details")->insert([
            "cs_scheme_id" => 1,
            "min_student" => 1,
        ]);
        DB::table("mst_outputs")->insert([
            "output_name" => "Output 1",
            "category" => "Kategori 1",
            "type" => 'Jurnal Nasional',
            'grade_prefix' => 'wow'
        ]);
        // DB::table("mst_community_service_req_outputs")->insert([
        //     "cs_scheme_id" => 1,
        //     "output_id" => 1,
        //     "category" => "wajib",
        //     "output_title" => "Judul 1",
        // ]);
        DB::table("mst_scientific_work_schemes")->insert([
            "sciwork_scheme" => "Skema 2",
            "status" => true,
            "category" => "jurnal",
        ]);
        DB::table("mst_scientific_work_req_details")->insert([
            "sw_scheme_id" => 1,
            "disciplines" => "sesuai keahlian",
        ]);
        $user = User::create([
            'name' => 'lili',
            'email' => 'lili@admin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'menuroles' => 'dosen'
        ]);
        $user->assignRole('dosen');

        DB::table("mst_research_req_details")->insert([
            "research_scheme_id" => 1,
            "min_mandatory_output" => 20,
            "complete_fund" => "luaran"
        ]);

        DB::table("mst_research_req_primary_outputs")->insert([
            "research_scheme_id" => 1,
            "output_id" => 1,
            "min_grade" => 2,
            "min_academic_position_id" => 1,
            "max_academic_position_id" => 2,
            "partner" => false,
            "partner_type" => "ok"
        ]);
        DB::table("mst_outputs")->insert([
            "output_name" => "luaran lol",
            "category" => 'penelitian',
            "type" => 'Jurnal Nasional',
            'grade_prefix' => 'wow'
        ]);
        DB::table("mst_research_req_secondary_outputs")->insert([
            "research_scheme_id" => 1,
            "output_id" => 2,
        ]);

        DB::table("mst_reviews")->insert([
            "total_main_criteria" => 1,
            "scheme" => "hai",
            "category" => "ok"

        ]);
        DB::table("mst_reviews_criteria_advanceds")->insert([
            "review_id" => 1,
            "schema_name" => "skema 1",
            "total_component" => 1
        ]);
        DB::table("mst_reviews_components")->insert([
            "criteria_adv_id" => 1,
            "component" => "lalala",
            "order" => 1
        ]);
        DB::table("mst_reviews_components_status")->insert([
            "component_id" => 1,
            "component_status" => "uuuu",
            "score" => 10
        ]);
        DB::table("mst_reviews_components")->insert([
            "criteria_adv_id" => 1,
            "component" => "eeeee",
            "order" => 1
        ]);
        DB::table("mst_reviews_components_status")->insert([
            "component_id" => 2,
            "component_status" => "mmmmmm",
            "score" => 11
        ]);
        // DB::table("mst_doc_template_types")->insert([
        //     "type_name" => "template1",
        //     "type_code" => "lap_kemajuan",
        // ]);
        DB::table("mst_faculties")->insert([
            "faculty_code" => "OOP2",
            "faculty_name" => "IT",
        ]);
        DB::table("mst_faculties")->insert([
            "faculty_code" => "OOP3",
            "faculty_name" => "Psi",
        ]);
        DB::table("mst_faculties")->insert([
            "faculty_code" => "OOP4",
            "faculty_name" => "Eko",
        ]);
        DB::table("mst_study_programs")->insert([
            "faculty_id" => 1,
            "prodi_code" => "prodi1",
            "prodi_name" => "Prodi 1",
            'grade' => 'A'
        ]);
        DB::table("mst_study_programs")->insert([
            "faculty_id" => 2,
            "prodi_code" => "prodi2",
            "prodi_name" => "Prodi 2",
            'grade' => 'A'
        ]);
        DB::table("mst_study_programs")->insert([
            "faculty_id" => 3,
            "prodi_code" => "prodi3",
            "prodi_name" => "Prodi 3",
            'grade' => 'A'
        ]);
        DB::table("users_details")->insert([
            "user_id" => "2",
            "faculty_id" => "1",
            'study_program_id' => '1'
        ]);
        DB::table("users_details")->insert([
            "user_id" => "3",
            "faculty_id" => "2",
            'study_program_id' => '2'
        ]);
        DB::table("scheme_periods")->insert([
            "year" => 2023,
            "type_id" => 1,
            'from_date' => '2023-01-01',
            'thru_date' => '2023-02-02'
        ]);
        DB::table("scheme_periods")->insert([
            "year" => 2023,
            "type_id" => 2,
            'from_date' => '2023-02-02',
            'thru_date' => '2023-12-12'
        ]);
        DB::table("research_headers")->insert([
            "period_id" => 1,
            "scheme_id" => 1,
            'title' => 'header1',
            'abstract' => 'abstract1',
            'status' => 'belum monev',
            'phase' => 'laporan kemajuan'
        ]);
        DB::table("research_documents")->insert([
            "research_header_id" => 1,
            "document_type_id" => 1,
            'directory' => 'header1',
        ]);
        DB::table("research_leaders")->insert([
            "research_header_id" => 1,
            "user_id" => 4,
            'study_program_id' => 2,
            "faculty_id" => 2,
        ]);
        DB::table("research_budget_allocations")->insert([
            "research_header_id" => 1,
            "disbursement_date_1" => '2023-08-08',
        ]);
        // DB::table("research_leaders")->insert([
        //     "research_header_id" => 1,
        //     "user_id" => 3,
        //     'study_program_id' => 2,
        //     "faculty_id" => 2,
        // ]);
        DB::table("research_reviewers")->insert([
            "research_header_id" => 1,
            "user_id" => 4,
            // 'reviewer_order',
            // 'review_status',
            // 'review_lk_status',
        ]);
        DB::table("research_review_lk_headers")->insert([
            "research_reviewer_id" => 1,
        ]);
        DB::table("research_primary_outputs")->insert([
            "research_header_id" => 1,
            "output_id" => 1,
            "grade" => 100,
            "title" => 'I love U Juster',
            'link' => "https://youtu.be/0-p5EbAsxUM?si=HhniulqQIEac-P9X",
            "status" => false,
        ]);
        DB::table("research_secondary_outputs")->insert([
            "research_header_id" => 1,
            "output_id" => 1,
            "title" => 'I love U Juster muah muah',
            'link' => "https://youtu.be/0-p5EbAsxUM?si=HhniulqQIEac-P9X",
            "status" => false,
        ]);
        DB::table("research_output_admin_notes")->insert([
            "research_header_id" => 1,
            "research_output_id" => 1,
            "admin_id" => 1,
            'mandatory' => true,
            "notes" => 'hahaha',
            "notes_date" => '2023-02-02',
        ]);
        DB::table("blocked_lecturers")->insert([
            "user_id" => 2,
            "from_date" => '2023-01-01',
            "thru_date" => '2023-12-12',
            'aborted' => false,
        ]);
        // DB::table("blocked_lecturers")->insert([
        //     "user_id" => 4,
        //     "from_date" => '2023-02-02',
        //     "thru_date" => '2023-12-12',
        //     'aborted' => false,
        // ]);
        DB::table("notifications")->insert([
            "target_user" => 'lppm',
            "message" => 'tes',
            "link" => 'aaa',
            'notification_date' => '2023-12-12',
        ]);
        // DB::table("users_grants")->insert([
        //     "user_id" => 1,
        //     "title" => 'Judul 1',
        //     "year" => 2023,
        // ]);
        DB::table("research_members")->insert([
            "research_header_id" => 1,
            "nik" => "111",
            "fullname" => "Phin Ajg",
            "nick" => "Phin",
            "nidn" => "222",
            "email" => "phin@email.com",
        ]);
        DB::table("incentive_headers")->insert([
            "user_id" => 4,
            "category" => "buku",
            "scientific_work_title" => "Phin Ajg",
            "status" => "PPD",
            'sw_scheme_id' => 1
        ]);
        DB::table("incentive_dates")->insert([
            "incentive_header_id" => 1,
            "submission_date" => "2023-12-12"
        ]);
        DB::table("incentive_teams")->insert([
            "incentive_header_id" => 1,
            "type" => "penulis lain",
            'is_correspondent' => true,
            'hierarchy' => 2,
            'name' => 'Team Babi',
            'user_id' => 4
        ]);
        DB::table("users_lecturers")->insert([
            "user_id" => 4,
            "nik" => "4",
            "nidk" => "4",
            "nidn" => "4",
            "golru_category_id" => 2,
            "academic_position_id" => 2,
            "faculty_id" => "1",
            'study_program_id' => '1'
        ]);
        DB::table("incentive_headers_budgets")->insert([
            "incentive_header_id" => 1,
            "budget_offer" => 10000.0,
        ]);
        DB::table("pkm_headers")->insert([
            "scheme_id" => 1,
            "title" => 'PkM Header 1',
            "duration_month" => 1,
            'deadline' => '2023-12-12',
            // "phase" => 'luaran',
            // 'status'=>"pengecekan kelengkapan"
        ]);
        DB::table("pkm_leaders")->insert([
            "pkm_header_id" => 1,
            "user_id" => 4,
            "faculty_id" => 1,
            "study_program_id" => 1,
        ]);
        DB::table("pkm_members")->insert([
            "pkm_header_id" => 1,
            // "user_id" => 2,
            "fullname" => 'Vika Chow',
            "email" => 'vika@email.com',
            "faculty_id" => 1,
            "study_program_id" => 1,
        ]);
        DB::table("mst_book_req_budgets")->insert([
            "book_scheme_id" => 1,
            "max_budget" => 1000,
        ]);
        DB::table("book_headers")->insert([
            "period_id" => 1,
            "book_scheme_id" => 1,
            "title" => 'Book Header 1',
            "duration_month" => 1,
            "phase" => 'proposal',
            // 'status' => "ditolak",
            // 'ppd_id_1' => 1
            // 'submission_date'=>"2023-08-08"
        ]);
        DB::table("book_headers")->insert([
            "period_id" => 2,
            "book_scheme_id" => 2,
            "title" => 'Book Header 2',
            "duration_month" => 1,
            "phase" => 'luaran',
            'status' => "diterima",
            // 'ppd_id_1' => 1
            // 'submission_date'=>"2023-08-08"
        ]);
        DB::table("book_leaders")->insert([
            "book_header_id" => 1,
            "user_id" => 4,
            "faculty_id" => 1,
            "study_program_id" => 1,
        ]);
        // DB::table("book_admin_notes")->insert([
        //     "book_header_id" => 1,
        //     "user_id" => 4,
        //     "notes" => "hey",
        //     "notes_category" => 'perlu revisi',
        //     "notes_date" => '2023-03-03',
        // ]);
        DB::table("book_budget_allocations")->insert([
            "book_header_id" => 1,
            "budget_allocation_1" => 4000.0,
            "budget_allocation_2" => 5000.0,
            "disbursement_date_1" => '2023-03-03',
            "disbursement_date_2" => '2023-03-04',
            "source" => 'fakultas',
        ]);
        DB::table("book_budget_allocations")->insert([
            "book_header_id" => 2,
            "budget_allocation_1" => 4000.0,
            "budget_allocation_2" => 5000.0,
            "disbursement_date_1" => '2023-03-03',
            "disbursement_date_2" => '2023-03-04',
            "source" => 'fakultas',
        ]);
        DB::table("mst_expertises")->insert([
            "faculty_id" => 1,
            "study_program_id" => 1,
            "expertise" => 'exp 1',
        ]);
        DB::table("mst_expertises")->insert([
            "faculty_id" => 1,
            "study_program_id" => 1,
            "expertise" => 'exp 2',
        ]);
        DB::table("mst_expertises")->insert([
            "faculty_id" => 1,
            "study_program_id" => 1,
            "expertise" => 'exp 3',
        ]);
        DB::table("book_reviewers")->insert([
            "book_header_id" => 1,
            "user_id" => 5,
        ]);
        DB::table("book_ppds")->insert([
            "period_id" => 2,
            "ppd_number" => 1,
        ]);
        DB::table("mst_reviews_criteria_mains")->insert([
            "review_id" => 1,
            "criteria" => 'buku1',
            "order" => 1,
        ]);
        DB::table("book_review_mains")->insert([
            "book_reviewer_id" => 1,
            "criteria_main_id" => 1,
            "order" => 1,
        ]);
        DB::table("mst_reviews_criteria_advanceds")->insert([
            "review_id" => 1,
            "schema_name" => 'buku1',
        ]);
        DB::table("book_review_advanceds")->insert([
            "book_reviewer_id" => 1,
            "criteria_adv_id" => 1,
            'total_component' => 1,
            'total_score' => 1,
        ]);
        DB::table("book_documents")->insert([
            "book_header_id" => 1,
            "document_type_id" => 1,
            'directory' => 'header1',
            'category'=>'cover'
        ]);
        // DB::table("blocked_lecturers_v2")->insert([
        //     "user_id" => 4,
        //     "from_date" => "2023-01-01",
        //     "role" => "anggota",
        //     "schema_category" => "penelitian",
        //     "schema_id" => 1
        // ]);
        // DB::table("users")->insert([
        //     "name"=>"vika",
        //     "email"=>"vika@email.com",
        //     "password"=>"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi",
        //     "menuroles"=>"fakultas",
        //     "role_id"=>4
        // ]);

        // $sws=new ScientificWorkScheme();
        // $sws->sciwork_scheme = "ok";
        // $sws->save();

        // $ih=new IncentiveHeader();
        // $ih->user_id = 1;
        // $ih->category = "buku";
        // $ih->scientific_work_title = "S1";
        // $ih->status = "lulus";
        // $ih->sw_scheme_id=1;
        // $ih->save();

        // $durasi=new ScientificWorkReqDetail();
        // $durasi->sw_scheme_id=1;
        // $durasi->duration=1;
        // $durasi->duration_type="bulan";
        // $durasi->disciplines="sesuai keahlian";
        // $durasi->save();

        // $date=new IncentiveDate();
        // $date->incentive_header_id=1;
        // $date->submission_date="2023-08-23";
        // $date->save();
    }
}
