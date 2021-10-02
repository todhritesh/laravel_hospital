<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use illuminate\Support\Facades\Auth;
use App\Models\Problem;


use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class AdminController extends Controller
{
    //staff
    public function staffCreate(){
        $branch = Branch::all();
        return view('admin.staff.staff_create',['branch'=>$branch]);
    }

    public function staffStore(Request $req){
        $staff = DB::table('users')->insert([
            'name'=>$req->name,
            'email'=>$req->email,
            'isadmin'=>'staff',
            'branch_id'=>$req->branch,
            'password'=>Hash::make($req->password),
        ]);

        return redirect()->back();

    }

    public function staffShow(){
        $staff = User::where('isadmin','staff')->get();
        return view('admin.staff.staff_show',['staff'=>$staff]);
    }

    public function staffEdit($id){
        $staff = User::find($id);
        return view('admin.staff.staff_edit',['staff'=>$staff]);
    }

    public function staffUpdate($id , Request $req){
        $staff = User::find($id);
        $staff->name = $req->name;
        $staff->email = $req->email;
        $staff->save();
        return redirect()->route('staff.show');
    }



    //patient
    public function patientCreate(){
        $branch = Branch::all();
        return view('admin.staff.patient.patient_create',['branch'=>$branch]);
    }

    public function patientStore(Request $req){
        $branch_id = Auth::user()->branch_id;
        $patient = DB::table('users')->insertGetId([
            'name'=>$req->name,
            'email'=>$req->email,
            'isadmin'=>'p',
            'branch_id'=>$branch_id,
        ]);

        $problem = new Problem();
        $problem->problem = $req->problem;
        $problem->problem_descr = $req->problem_descr;
        $problem->user_id = $patient;
        $problem->save();

        return redirect()->back();

    }

    public function patientShow(){
        $branch_id = Auth::user()->branch_id;
        $patient = User::where([['isadmin','p'],['branch_id',$branch_id]])->get();
        return view('admin.staff.patient.patient_show',['patient'=>$patient]);
    }

    public function patientEdit($id){
        $patient = User::find($id);
        return view('admin.staff.patient.patient_edit',['patient'=>$patient]);
    }

    public function patientUpdate($id , Request $req){
        $patient = User::find($id);
        $patient->name = $req->name;
        $patient->email = $req->email;
        $patient->update();
        $pro = Problem::where('user_id',$id)->first();
        $pro->problem = $req->problem;
        $pro->problem_descr = $req->problem_descr;
        $pro->save();
        return redirect()->route('patient.show');
    }

    public function patientDelete($id){
        $patient = User::find($id)->delete();
        $pro = Problem::where('user_id',$id)->delete();
        return redirect()->route('patient.show');
    }




    // doctor
    public function doctorCreate(){
        $branch = Branch::all();
        return view('admin.doctor.doctor_create',['branch'=>$branch]);
    }

    public function doctorStore(Request $req){
        $doctor = DB::table('users')->insert([
            'name'=>$req->name,
            'email'=>$req->email,
            'isadmin'=>'doctor',
            'branch_id'=>$req->branch,
            'password'=>Hash::make($req->password),
        ]);

        return redirect()->back();

    }

    public function doctorShow(){
        $doctor = User::where('isadmin','doctor')->get();
        return view('admin.doctor.doctor_show',['doctor'=>$doctor]);
    }

    public function doctorEdit($id){
        $doctor = User::find($id);
        $branch = Branch::all();
        return view('admin.doctor.doctor_edit',['doctor'=>$doctor,'branch'=>$branch]);
    }

    public function doctorUpdate($id , Request $req){
        $doctor = User::find($id);
        $doctor->name = $req->name;
        $doctor->email = $req->email;
        $doctor->branch_id = $req->branch;
        $doctor->update();

        return redirect()->route('doctor.show');
    }

    public function doctorDelete($id){
        $doctor = User::find($id);
        $doctor->delete();
        return redirect()->route('doctor.show');
    }

    public function doctorBranchPatient(){
        $patient = User::where([['isadmin','p'],['branch_id',Auth::user()->branch_id]])->get();
        return view('admin.doctor_branch_patient',['patient'=>$patient]);
    }

    public function totalPatientView(){
        $patient = User::where('isadmin','p')->get();
        return view('admin.total_patient_view',['patient'=>$patient]);
    }
}
