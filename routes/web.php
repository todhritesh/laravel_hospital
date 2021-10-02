<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\BranchController;
use App\Http\Controllers\AdminController;
use App\Models\User;
use Carbon\Carbon;



use App\Http\Controllers\Auth\RegisteredUserController;


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

route::view('/test',"admin.test");


Route::middleware('auth')->group(function(){
    Route::middleware('admin')->group(function(){
        Route::get('branch/form',[BranchController::class,"create"])->name('branch.create');
        Route::post('branch/store',[BranchController::class,"store"])->name('branch.store');
        Route::get('branch/show',[BranchController::class,"show"])->name('branches.show');
        // Route::delete('branch/delete/{id}',[BranchController::class,"destroy"])->name('branch.destroy');
        Route::post('branch/edit/{id}',[BranchController::class,"edit"])->name('branch.edit');
        Route::put('branch/edit/{id}',[BranchController::class,"update"])->name('branch.update');

        Route::get('/staff/create',[AdminController::class,"staffCreate"])->name('staff.create');
        Route::post('/staff/store',[AdminController::class,"staffStore"])->name('staff.store');
        Route::get('/staff/show',[AdminController::class,"staffshow"])->name('staff.show');
        Route::post('/staff/edit/{id}',[AdminController::class,"staffEdit"])->name('staff.edit');
        Route::put('/staff/update/{id}',[AdminController::class,"staffUpdate"])->name('staff.update');

        Route::get('/doctor/create',[AdminController::class,"doctorCreate"])->name('doctor.create');
        Route::post('/doctor/store',[AdminController::class,"doctorStore"])->name('doctor.store');
        Route::get('/doctor/show',[AdminController::class,"doctorshow"])->name('doctor.show');
        Route::post('/doctor/edit/{id}',[AdminController::class,"doctorEdit"])->name('doctor.edit');
        Route::post('/doctor/update/{id}',[AdminController::class,"doctorUpdate"])->name('doctor.update');
        Route::delete('/doctor/delete/{id}',[AdminController::class,"doctorDelete"])->name('doctor.delete');

        Route::get('/total/patient',[AdminController::class,"totalPatientView"])->name('total.patient.view');



    });

    Route::middleware('staff')->group(function(){

        Route::get('/patient/create',[AdminController::class,"patientCreate"])->name('patient.create');
        Route::post('/patient/store',[AdminController::class,"patientStore"])->name('patient.store');
        Route::get('/patient/show',[AdminController::class,"patientShow"])->name('patient.show');
        Route::post('/patient/edit/{id}',[AdminController::class,"patientEdit"])->name('patient.edit');
        Route::patch('/patient/update/{id}',[AdminController::class,"patientUpdate"])->name('patient.update');
        Route::delete('/patient/delete/{id}',[AdminController::class,"patientDelete"])->name('patient.delete');

    });

    Route::middleware('doctor')->group(function(){
        Route::get('/doctor/branch/patient',[AdminController::class,"doctorBranchPatient"])->name('doctor_branch_patient');
    });


    Route::get('/dashboard', function () {
        $graph = DB::select(DB::raw("select count(name) as total_patients , branch_name from users join branches on users.branch_id = branches.id where branch_id!='' group by branch_name"));
        // $line_graph = DB::select(DB::raw("select count(name) as total_patients , users.created_at from users join branches on users.branch_id = branches.id where branch_id!='' group by users.created_at"));
        $chart = " ";
        foreach($graph as $g){
            $chart.="['".$g->branch_name."',".$g->total_patients."],";
        }

        $patients = User::distinct()->where('isadmin','p')->orderBy('created_at','desc')->get(['created_at']);
        // $patients = User::distinct()->where([['isadmin','p'],['branch_id',Auth::user()->branch_id]])->orderBy('created_at','desc')->get(['created_at']);
        $ps = $patients->toArray();
        $patient = array_map(function($patient) {
            return $patient['created_at'];
        }, $ps);

        $a = User::where('isadmin','p')->whereDate('created_at','=', Carbon::today()->subDays(3))->get();

        $b = User::where('isadmin','p')->whereDate('created_at','=', Carbon::today()->subDays(2))->get();

        $c = User::where('isadmin','p')->whereDate('created_at','=', Carbon::today()->subDays(1))->get();

        $d = User::where('isadmin','p')->whereDate('created_at','=', Carbon::today()->subDays(0))->get();




        $chart = rtrim($chart,",");

        return view('admin.admin_dashboard',['chart_data'=>$chart,'patient'=>$patient, 'a'=>$a,'b'=>$b, 'c'=>$c, 'd'=>$d]);
    })->middleware(['auth'])->name('dashboard');
});

Route::get('/', function () {
    return view('welcome');
});


require __DIR__.'/auth.php';
