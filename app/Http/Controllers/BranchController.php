<?php

namespace App\Http\Controllers;
use App\Models\Branch;

use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function create(){
        return view('admin.branch_form');
    }

    public function store(Request $req){
        $b = new Branch();
        $b->branch_name = $req->name;
        $b->amount = $req->amount;
        $b->save();
        $msg = session()->flash('msg','Branch Added successfully');
        return redirect()->back();
    }

    public function show(){
        $branch =Branch::all();
        return view('admin.branch_show',['branches'=>$branch]);
    }

    // public function destroy($id){
    //     $b = Branch::find($id);
    //     $b->delete();
    //     return redirect()->back();
    // }

    public function edit($id){
        $branch = Branch::find($id);
        return view('admin.branch_edit',['branch'=>$branch]);
    }

    public function update($id , Request $req){
        $branch = Branch::find($id);
        $branch->branch_name = $req->name;
        $branch->amount = $req->amount;
        $branch->update();
        return redirect()->route('branches.show');
    }
}
