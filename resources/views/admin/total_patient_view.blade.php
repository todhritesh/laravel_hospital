@extends('admin.admin_layout')

@section('content')

<div class="container">
    <div class="row">
        <h4>Total Patients</h4>
        <div class="col-12">
            <table class="table table-borderless table-hover table-small">
                <tr>
                    <th>Id</th>
                    <th>Patient Name</th>
                    <th>Email</th>
                    <th>Problem</th>
                    <th>Fee</th>
                </tr>

                @foreach ($patient as $p)
                    <tr class="small">
                        <td>{{$p->id}}</td>
                        <td>{{$p->name}}</td>
                        <td >{{$p->email}}</td>
                        <td class='fw-bold'  style="width:300px">
                            {{($p->pro!=null)?$p->pro->problem:null}}
                            :-<br>
                            <small class="lead small">{{($p->pro!=null)?$p->pro->problem_descr:null}}</small>
                        </td>
                        <td >Rs. {{$p->branch->amount}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

@endsection
