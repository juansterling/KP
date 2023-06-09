<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\Master\BookScheme;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\OutputController;
use App\Http\Controllers\Master\StatusController;
use App\Http\Controllers\Master\BookSchemeController;
use App\Http\Controllers\Master\ResearchTypeController;
use App\Http\Controllers\Master\MasterQuestionerTKTController;
use App\Http\Controllers\Master\FeaturedTopicController;
use App\Http\Controllers\Master\WorkConditionController;
use App\Http\Controllers\Master\ResearchSchemeController;
use App\Http\Controllers\Master\AreaOfExpertiseController;
use App\Http\Controllers\Master\AcademicPositionController;
use App\Http\Controllers\Master\StudentProgrammeController;
use App\Http\Controllers\QuestionerTKT\QuestionerController;
use App\Http\Controllers\Master\FacultyStudyProgramController;
use App\Http\Controllers\Master\ScientificWorkSchemeController;
use App\Http\Controllers\Master\CommunityServiceSchemeController;

Route::group(['middleware' => ['get.menu']], function () {
    Route::get('/', function () {
        return view('dashboard.homepage');
    });

    Route::group(['middleware' => ['role:user']], function () {
        Route::get('/colors', function () {
            return view('dashboard.colors');
        });
        Route::get('/typography', function () {
            return view('dashboard.typography');
        });
        Route::get('/charts', function () {
            return view('dashboard.charts');
        });
        Route::get('/widgets', function () {
            return view('dashboard.widgets');
        });
        Route::get('/404', function () {
            return view('dashboard.404');
        });
        Route::get('/500', function () {
            return view('dashboard.500');
        });
        Route::prefix('base')->group(function () {
            Route::get('/breadcrumb', function () {
                return view('dashboard.base.breadcrumb');
            });
            Route::get('/cards', function () {
                return view('dashboard.base.cards');
            });
            Route::get('/carousel', function () {
                return view('dashboard.base.carousel');
            });
            Route::get('/collapse', function () {
                return view('dashboard.base.collapse');
            });

            Route::get('/forms', function () {
                return view('dashboard.base.forms');
            });
            Route::get('/jumbotron', function () {
                return view('dashboard.base.jumbotron');
            });
            Route::get('/list-group', function () {
                return view('dashboard.base.list-group');
            });
            Route::get('/navs', function () {
                return view('dashboard.base.navs');
            });

            Route::get('/pagination', function () {
                return view('dashboard.base.pagination');
            });
            Route::get('/popovers', function () {
                return view('dashboard.base.popovers');
            });
            Route::get('/progress', function () {
                return view('dashboard.base.progress');
            });
            Route::get('/scrollspy', function () {
                return view('dashboard.base.scrollspy');
            });

            Route::get('/switches', function () {
                return view('dashboard.base.switches');
            });
            Route::get('/tables', function () {
                return view('dashboard.base.tables');
            });
            Route::get('/tabs', function () {
                return view('dashboard.base.tabs');
            });
            Route::get('/tooltips', function () {
                return view('dashboard.base.tooltips');
            });
        });
        Route::prefix('buttons')->group(function () {
            Route::get('/buttons', function () {
                return view('dashboard.buttons.buttons');
            });
            Route::get('/button-group', function () {
                return view('dashboard.buttons.button-group');
            });
            Route::get('/dropdowns', function () {
                return view('dashboard.buttons.dropdowns');
            });
            Route::get('/brand-buttons', function () {
                return view('dashboard.buttons.brand-buttons');
            });
        });
        Route::prefix('icon')->group(function () {  // word: "icons" - not working as part of adress
            Route::get('/coreui-icons', function () {
                return view('dashboard.icons.coreui-icons');
            });
            Route::get('/flags', function () {
                return view('dashboard.icons.flags');
            });
            Route::get('/brands', function () {
                return view('dashboard.icons.brands');
            });
        });
        Route::prefix('notifications')->group(function () {
            Route::get('/alerts', function () {
                return view('dashboard.notifications.alerts');
            });
            Route::get('/badge', function () {
                return view('dashboard.notifications.badge');
            });
            Route::get('/modals', function () {
                return view('dashboard.notifications.modals');
            });
        });
        Route::resource('notes', 'NotesController');
    });
    Auth::routes();

    Route::resource('resource/{table}/resource', 'ResourceController')->names([
        'index'     => 'resource.index',
        'create'    => 'resource.create',
        'store'     => 'resource.store',
        'show'      => 'resource.show',
        'edit'      => 'resource.edit',
        'update'    => 'resource.update',
        'destroy'   => 'resource.destroy'
    ]);

    Route::group(['middleware' => ['role:admin']], function () {
        Route::resource('bread',  'BreadController');   //create BREAD (resource)
        Route::resource('users',        'UsersController')->except(['create', 'store']);
        Route::resource('roles',        'RolesController');
        Route::resource('mail',        'MailController');
        Route::get('prepareSend/{id}',        'MailController@prepareSend')->name('prepareSend');
        Route::post('mailSend/{id}',        'MailController@send')->name('mailSend');
        Route::get('/roles/move/move-up',      'RolesController@moveUp')->name('roles.up');
        Route::get('/roles/move/move-down',    'RolesController@moveDown')->name('roles.down');
        Route::prefix('menu/element')->group(function () {
            Route::get('/',             'MenuElementController@index')->name('menu.index');
            Route::get('/move-up',      'MenuElementController@moveUp')->name('menu.up');
            Route::get('/move-down',    'MenuElementController@moveDown')->name('menu.down');
            Route::get('/create',       'MenuElementController@create')->name('menu.create');
            Route::post('/store',       'MenuElementController@store')->name('menu.store');
            Route::get('/get-parents',  'MenuElementController@getParents');
            Route::get('/edit',         'MenuElementController@edit')->name('menu.edit');
            Route::post('/update',      'MenuElementController@update')->name('menu.update');
            Route::get('/show',         'MenuElementController@show')->name('menu.show');
            Route::get('/delete',       'MenuElementController@delete')->name('menu.delete');
        });
        Route::prefix('menu/menu')->group(function () {
            Route::get('/',         'MenuController@index')->name('menu.menu.index');
            Route::get('/create',   'MenuController@create')->name('menu.menu.create');
            Route::post('/store',   'MenuController@store')->name('menu.menu.store');
            Route::get('/edit',     'MenuController@edit')->name('menu.menu.edit');
            Route::post('/update',  'MenuController@update')->name('menu.menu.update');
            Route::get('/delete',   'MenuController@delete')->name('menu.menu.delete');
        });
        Route::prefix('media')->group(function () {
            Route::get('/',                 'MediaController@index')->name('media.folder.index');
            Route::get('/folder/store',     'MediaController@folderAdd')->name('media.folder.add');
            Route::post('/folder/update',   'MediaController@folderUpdate')->name('media.folder.update');
            Route::get('/folder',           'MediaController@folder')->name('media.folder');
            Route::post('/folder/move',     'MediaController@folderMove')->name('media.folder.move');
            Route::post('/folder/delete',   'MediaController@folderDelete')->name('media.folder.delete');;

            Route::post('/file/store',      'MediaController@fileAdd')->name('media.file.add');
            Route::get('/file',             'MediaController@file');
            Route::post('/file/delete',     'MediaController@fileDelete')->name('media.file.delete');
            Route::post('/file/update',     'MediaController@fileUpdate')->name('media.file.update');
            Route::post('/file/move',       'MediaController@fileMove')->name('media.file.move');
            Route::post('/file/cropp',      'MediaController@cropp');
            Route::get('/file/copy',        'MediaController@fileCopy')->name('media.file.copy');
        });
    });

    Route::group(['middleware' => ['role:admin|lppm']], function () {
        Route::prefix('master')->group(function () {

            Route::prefix('topik-unggulan')->group(function () {
                Route::get('/', [FeaturedTopicController::class, 'index_featured_topic']);
                Route::post('/', [FeaturedTopicController::class, 'store_featured_topic']);
                Route::patch('/', [FeaturedTopicController::class, 'update_featured_topic']);
                Route::delete('/', [FeaturedTopicController::class, 'delete_featured_topic']);
                Route::post('update-status', [FeaturedTopicController::class, 'update_status_featured_topic']);
            });


            Route::get('/fakultas', [FacultyStudyProgramController::class, 'index_faculty']);
            Route::delete('/fakultas', [FacultyStudyProgramController::class, 'delete_faculty']);
            Route::post('/fakultas/sync_sat', [FacultyStudyProgramController::class, 'sync_faculty_sat']);
            Route::get('/fakultas/{faculty_id}', [FacultyStudyProgramController::class, 'index_study_program']);
            Route::delete('/fakultas/{faculty_id}', [FacultyStudyProgramController::class, 'delete_study_program']);
            Route::post('/fakultas/{faculty_id}/sync_sat', [FacultyStudyProgramController::class, 'sync_study_program_sat']);

            Route::get('/status', [StatusController::class, 'index_status']);
            Route::post('/status', [StatusController::class, 'store_status']);
            Route::patch('/status', [StatusController::class, 'update_status']);
            Route::delete('/status', [StatusController::class, 'delete_status']);

            Route::get("/jenis-penelitian", [ResearchTypeController::class, "index_research_type"])->name("research-type");
            Route::post("/jenis-penelitian", [ResearchTypeController::class, "store_research_type"]);
            Route::patch("/jenis-penelitian", [ResearchTypeController::class, "update_research_type"]);
            Route::delete("/jenis-penelitian", [ResearchTypeController::class, "delete_research_type"]);

            Route::get('/program-mahasiswa', [StudentProgrammeController::class, 'index_student_programme']);
            Route::post('/program-mahasiswa', [StudentProgrammeController::class, 'store_student_programme']);
            Route::patch('/program-mahasiswa', [StudentProgrammeController::class, 'update_student_programme']);
            Route::delete('/program-mahasiswa', [StudentProgrammeController::class, 'delete_student_programme']);

            Route::get('/luaran', [OutputController::class, 'index_output']);
            Route::post('/luaran', [OutputController::class, 'store_output']);
            Route::patch('/luaran', [OutputController::class, 'update_output']);
            Route::delete('/luaran', [OutputController::class, 'delete_output']);

            Route::get('/bidang-keahlian', [AreaOfExpertiseController::class, 'index_aoe']);
            Route::post('/bidang-keahlian', [AreaOfExpertiseController::class, 'store_aoe']);
            Route::patch('/bidang-keahlian', [AreaOfExpertiseController::class, 'update_aoe']);
            Route::delete('/bidang-keahlian', [AreaOfExpertiseController::class, 'delete_aoe']);

            Route::get('/prasyarat-kerja', [WorkConditionController::class, 'index_work_condition']);
            Route::post('/prasyarat-kerja', [WorkConditionController::class, 'store_work_condition']);
            Route::patch('/prasyarat-kerja', [WorkConditionController::class, 'update_work_condition']);
            Route::delete('/prasyarat-kerja', [WorkConditionController::class, 'delete_work_condition']);

            Route::get("jabatan-akademik", [AcademicPositionController::class, "index_academic_position"]);
            Route::post("jabatan-akademik", [AcademicPositionController::class, "store_academic_position"]);
            Route::patch("jabatan-akademik", [AcademicPositionController::class, "update_academic_position"]);
            Route::delete("jabatan-akademik", [AcademicPositionController::class, "delete_academic_position"]);

            Route::get("skema-penelitian", [ResearchSchemeController::class, "index_research_scheme"]);
            Route::post("skema-penelitian", [ResearchSchemeController::class, "store_research_scheme"]);
            Route::post("skema-penelitian/update-status", [ResearchSchemeController::class, "update_status"]);
            Route::patch("skema-penelitian", [ResearchSchemeController::class, "update_research_scheme"]);
            Route::delete("skema-penelitian", [ResearchSchemeController::class, "delete_research_scheme"]);


            Route::get("/skema-penelitian/{research_scheme_id}/requirement", [ResearchSchemeController::class, "index_research_req"]);

            Route::get("skema-buku", [BookSchemeController::class, "index_book_scheme"]);
            Route::post("skema-buku", [BookSchemeController::class, "store_book_scheme"]);
            Route::post("skema-buku/update-status", [BookSchemeController::class, "update_status"]);
            Route::patch("skema-buku", [BookSchemeController::class, "update_book_scheme"]);
            Route::delete("skema-buku", [BookSchemeController::class, "delete_book_scheme"]);

            Route::get("skema-pelayanan-publik", [CommunityServiceSchemeController::class, "index_comsv_scheme"]);
            Route::post("skema-pelayanan-publik", [CommunityServiceSchemeController::class, "store_comsv_scheme"]);
            Route::patch("skema-pelayanan-publik", [CommunityServiceSchemeController::class, "update_comsv_scheme"]);
            Route::delete("skema-pelayanan-publik", [CommunityServiceSchemeController::class, "delete_comsv_scheme"]);

            Route::post("skema-pelayanan-publik/update-status", [CommunityServiceSchemeController::class, "update_status"]);
            Route::get("skema-pelayanan-publik/{community_service_scheme_id}/requirement", [CommunityServiceSchemeController::class, "index_cs_req"]);

            Route::get("skema-pelayanan-publik/{community_service_scheme_id}/requirement/detail", [CommunityServiceSchemeController::class, "index_cs_req_detail"]);
            Route::post("skema-pelayanan-publik/{community_service_scheme_id}/requirement/detail", [CommunityServiceSchemeController::class, "store_cs_req_detail"]);

            Route::get('skema-penelitian/{research_scheme_id}/requirement/detail', [ResearchSchemeController::class, "index_research_req_detail"]);
            Route::post('skema-penelitian/{research_scheme_id}/requirement/detail', [ResearchSchemeController::class, "store_research_req_detail"]);

            Route::get("/skema-karya-ilmiah", [ScientificWorkSchemeController::class, "index_scientific_work_scheme"]);
            Route::post("/skema-karya-ilmiah", [ScientificWorkSchemeController::class, "store_scientific_work_scheme"]);
            Route::patch("/skema-karya-ilmiah", [ScientificWorkSchemeController::class, "update_scientific_work_scheme"]);
            Route::delete("/skema-karya-ilmiah", [ScientificWorkSchemeController::class, "delete_scientific_work_scheme"]);
            Route::post("/skema-karya-ilmiah/update-status", [ScientificWorkSchemeController::class, "update_status"]);

            Route::get("/skema-karya-ilmiah/{scientific_work_scheme_id}/requirement", [ScientificWorkSchemeController::class, "index_cs_req"]);

            Route::get('skema-penelitian/{research_scheme_id}/requirement/program', [ResearchSchemeController::class, "index_research_sp_req"]);
            Route::post('skema-penelitian/{research_scheme_id}/requirement/program', [ResearchSchemeController::class, "store_research_req_sp"]);
            Route::delete('skema-penelitian/{research_scheme_id}/requirement/program', [ResearchSchemeController::class, "delete_research_req_sp"]);

            Route::get('skema-penelitian/{research_scheme_id}/requirement/dosen', [ResearchSchemeController::class, "index_research_req_lecturer"]);
            Route::post('skema-penelitian/{research_scheme_id}/requirement/dosen', [ResearchSchemeController::class, "store_research_req_lecturer"]);

            Route::get("skema-penelitian/{research_scheme_id}/requirement/luaran", [ResearchSchemeController::class, "index_research_req_output"]);
            Route::post("skema-penelitian/{research_scheme_id}/requirement/luaran", [ResearchSchemeController::class, "store_research_req_output"]);
            Route::patch("skema-penelitian/{research_scheme_id}/requirement/luaran", [ResearchSchemeController::class, "update_research_req_output"]);
            Route::delete("skema-penelitian/{research_scheme_id}/requirement/luaran", [ResearchSchemeController::class, "delete_research_req_output"]);

            Route::get("skema-penelitian/{research_scheme_id}/requirement/anggaran", [ResearchSchemeController::class, "index_research_req_budget"]);
            Route::post("skema-penelitian/{research_scheme_id}/requirement/anggaran", [ResearchSchemeController::class, "store_research_req_budget"]);

            Route::get("skema-buku/{book_scheme_id}/requirement/anggaran", [BookSchemeController::class, "index_book_req_budget"]);
            Route::post("skema-buku/{book_scheme_id}/requirement/anggaran", [BookSchemeController::class, "store_book_req_budget"]);

            Route::get("skema-pelayanan-publik/{community_service_scheme_id}/requirement/program", [CommunityServiceSchemeController::class, "index_cs_req_program"]);
            Route::post("skema-pelayanan-publik/{community_service_scheme_id}/requirement/program", [CommunityServiceSchemeController::class, "store_cs_req_program"]);
            Route::delete("skema-pelayanan-publik/{community_service_scheme_id}/requirement/program", [CommunityServiceSchemeController::class, "delete_cs_req_program"]);

            Route::get("skema-buku/{book_scheme_id}/requirement/revisi", [BookSchemeController::class, "index_book_req_rev"]);
            Route::post("skema-buku/{book_scheme_id}/requirement/revisi", [BookSchemeController::class, "store_book_req_rev"]);

            Route::get("skema-buku/{book_scheme_id}/requirement", [BookSchemeController::class, "index_book_req"]);

            Route::get("skema-buku/{book_scheme_id}/requirement/detail", [BookSchemeController::class, "index_book_req_detail"]);
            Route::post("skema-buku/{book_scheme_id}/requirement/detail", [BookSchemeController::class, "store_book_req_detail"]);

            Route::get("skema-buku/{book_scheme_id}/requirement/luaran", [BookSchemeController::class, "index_book_req_output"]);
            Route::post("skema-buku/{book_scheme_id}/requirement/luaran", [BookSchemeController::class, "store_book_req_output"]);
            Route::patch("skema-buku/{book_scheme_id}/requirement/luaran", [BookSchemeController::class, "update_book_req_output"]);
            Route::delete("skema-buku/{book_scheme_id}/requirement/luaran", [BookSchemeController::class, "delete_book_req_output"]);

            Route::get("skema-pelayanan-publik/{community_scheme_id}/requirement/anggaran", [CommunityServiceSchemeController::class, "index_cs_req_budget"]);
            Route::post("skema-pelayanan-publik/{community_scheme_id}/requirement/anggaran", [CommunityServiceSchemeController::class, "store_cs_req_budget"]);

            Route::get("skema-pelayanan-publik/{community_service_scheme_id}/requirement/luaran", [CommunityServiceSchemeController::class, "index_cs_req_output"]);
            Route::post("skema-pelayanan-publik/{community_service_scheme_id}/requirement/luaran", [CommunityServiceSchemeController::class, "store_cs_req_output"]);
            Route::patch("skema-pelayanan-publik/{community_service_scheme_id}/requirement/luaran", [CommunityServiceSchemeController::class, "update_cs_req_output"]);
            Route::delete("skema-pelayanan-publik/{community_service_scheme_id}/requirement/luaran", [CommunityServiceSchemeController::class, "delete_cs_req_output"]);

            Route::get("skema-karya-ilmiah/{scientific_work_scheme_id}/requirement/detail", [ScientificWorkSchemeController::class, "index_sw_req_detail"]);
            Route::post("skema-karya-ilmiah/{scientific_work_scheme_id}/requirement/detail", [ScientificWorkSchemeController::class, "store_sw_req_detail"]);

            Route::get("skema-karya-ilmiah/{scientific_work_scheme_id}/requirement/anggaran", [ScientificWorkSchemeController::class, "index_sw_req_budget"]);
            Route::post("skema-karya-ilmiah/{scientific_work_scheme_id}/requirement/anggaran", [ScientificWorkSchemeController::class, "store_sw_req_budget"]);

            Route::get("skema-karya-ilmiah/{scientifec_work_scheme_id}/requirement/syarat-karya", [ScientificWorkSchemeController::class, "index_sw_req_condition"]);
            Route::post("skema-karya-ilmiah/{scientifec_work_scheme_id}/requirement/syarat-karya", [ScientificWorkSchemeController::class, "store_sw_req_condition"]);
            Route::delete("skema-karya-ilmiah/{scientifec_work_scheme_id}/requirement/syarat-karya", [ScientificWorkSchemeController::class, "delete_sw_req_condition"]);

            Route::get("tkt/category", [MasterQuestionerTKTController::class, "index_tkt_category"]);
            Route::post("tkt/category", [MasterQuestionerTKTController::class, "store_tkt_category"]);
            Route::delete("tkt/category", [MasterQuestionerTKTController::class, "delete_tkt_category"]);
            Route::patch("tkt/category", [MasterQuestionerTKTController::class, "update_tkt_category"]);

            Route::get('tkt/category/{tkt_category_id}', [MasterQuestionerTKTController::class, 'index_tkt_indicator']);
            Route::post('tkt/category/{tkt_category_id}', [MasterQuestionerTKTController::class, 'store_tkt_indicator']);
            Route::patch('tkt/category/{tkt_category_id}', [MasterQuestionerTKTController::class, 'update_tkt_indicator']);
            Route::delete('tkt/category/{tkt_category_id}', [MasterQuestionerTKTController::class, 'delete_tkt_indicator']);
            Route::post('tkt/category/{tkt_category_id}/update-status', [MasterQuestionerTKTController::class, 'update_status_tkt_indicator']);

            Route::get("tkt/percentage", [MasterQuestionerTKTController::class, "index_tkt_percentage"]);
            Route::post("tkt/percentage", [MasterQuestionerTKTController::class, "store_tkt_percentage"]);
            Route::patch("tkt/percentage", [MasterQuestionerTKTController::class, "update_tkt_percentage"]);
            Route::delete("tkt/percentage", [MasterQuestionerTKTController::class, "delete_tkt_percentage"]);
        });
    });

    Route::group(['middleware' => ['role:admin|lppm|dosen']], function () {
        Route::prefix('kuisioner-tkt')->group(function () {
            Route::get('/pengukuran', [QuestionerController::class, 'tkt_activity_header']);
            Route::post('/pengukuran', [QuestionerController::class, 'store_tkt_activity_header']);
            Route::get('/pengukuran/{tkt_activity_header_id}', [QuestionerController::class, 'show_tkt_activity']);
            Route::patch('/pengukuran/{tkt_activity_header_id}', [QuestionerController::class, 'update_tkt_activity_header']);
            Route::post('/pengukuran/{tkt_activity_header_id}', [QuestionerController::class, 'store_tkt_activity_detail_indicator']);
            Route::post('/pengukuran/{tkt_activity_header_id}/update-indicator', [QuestionerController::class, 'update_tkt_activity_detail_indicator']);
        });
    });
});
